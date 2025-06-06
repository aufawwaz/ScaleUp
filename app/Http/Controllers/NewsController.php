<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\View\Components\NewsCard;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    /**
     * ambil 30 news data from newsdata.io
     * WARNING: ini tuh pakai API gratis jadi cuma bisa 200 request/hari
     */
    private function getNewsFromApi()
    {
        $allNews = [];
        $nextPage = null;
        $counter = 0;

        while ($counter < 3) {
            $params = [
                'apikey'   => 'pub_1c18244deee444c3a3fcf786bdec02a3',
                'q'        => 'business',
                'language' => 'id',
            ];

            if ($nextPage) {
                $params['page'] = $nextPage;
            }

            $response = Http::get('https://newsdata.io/api/1/latest', $params);

            if (! $response->successful()) {
                return null;
            }

            $json = $response->json();
            $results = $json['results'] ?? [];

            $allNews = array_merge($allNews, $results);
            $nextPage = $json['nextPage'] ?? null;

            if (! $nextPage) break;
            $counter++;
        }

        return [
            'results' => $allNews,
            'nextPage' => $nextPage
        ];
    }

    /**
     * return fetch berita dan disimpan ke cache
     * @return JsonResponse
     */
    public function fetchNews()
    {
        $data = $this->getNewsFromApi();

        if ($data) {
            Cache::put('cached_news_data', $data, now()->addMinutes(60));
            return response()->json($data);
        }
        return response()->json(['message' => 'Gagal mengambil data dari NewsData.io']);
    }

    /**
     * return fetch dari cache, kalau kosong fetch dulu
     * @return JsonResponse
     */
    public function getFetchNews()
    {
        $data = Cache::get('cached_news_data');

        if (!$data) {
            $data = $this->getNewsFromApi();

            if ($data) {
                Cache::put('cached_news_data', $data, now()->addMinutes(value: 60));
            } else {
                return response()->json(['message' => 'Gagal mengambil data dari NewsData.io']);
            }
        }
        return response()->json($data);
    }
    /**
     * eeturn cache, kalau kosong fetch dulu
     * @return Collection
     */
    public function getFetchNews_Array()
    {
        $data = Cache::get('cached_news_data');

        if (!$data) {
            $data = $this->getNewsFromApi();

            if ($data) {
                Cache::put('cached_news_data', $data, now()->addMinutes(10));
            } else {
                return response()->json(['message' => 'Gagal mengambil data dari NewsData.io']);
            }
        }
        return collect($data['results'] ?? []);
    }

    /**
     * create news-card dengan pagination
     */
    public function fetchNewsHTML(Request $request)
    {
        $data = $this->getFetchNews_Array();
        $perPage = 9;
        $page = (int) $request->input('page', 1);
        $offset = ($page - 1) * $perPage;
        $cards = $data->slice(1); // skip berita pertama
        $total = $cards->count();
        $paginated = $cards->slice($offset, $perPage);

        if ($paginated->isEmpty()) {
            return response()->json([
                'html' => '<p class="text-sm text-gray">Tidak ada berita lainnya saat ini</p>',
                'total' => $total
            ]);
        }

        $html = '';
        foreach ($paginated as $d) {
            $d = (array) $d;
            $news = [
                'article_id'  => $d['article_id'] ?? '',
                'title'       => $d['title'] ?? '',
                'description' => $d['description'] ?? 'Deskripsi Kosong',
                'image_url'   => $d['image_url'] ?? $d['image'] ?? asset('asset/news_dummy_image.png'),
                'pubDate'     => $d['pubDate'] ?? $d['date']   ?? now()->toDateString(),
                'source_id'   => $d['source_id'] ?? '-',
            ];

            $component = new NewsCard($news);
            $html .= view('components.news-card', [
                'id'          => $component->id,
                'title'       => $component->title,
                'description' => $component->description,
                'image'       => $component->image,
                'date'        => $component->date,
                'source'      => $component->source,
            ])->render();
        }
        return response()->json(['html' => $html, 'total' => $total]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->getFetchNews_Array();

        if($data->isEmpty()){
            $dummy = (object)[
                'title' => 'Kabar Berita',
                'description' => 'Nantikan pembaharuan kami selanjutnya',
                'view' => 0,
                'date' => now()->toDateString(),
                'content' => 'Kosong :(',
                'image_url' => 'asset/news_dummy_image.png',
                'source_id' => '-'
            ];
            $data = collect([$dummy]);
            $firstNews = $dummy;
        } else {
            $d = (array) $data[0];

            $image_url = $d['image_url'] ?? ($d['image'] ?? '');
            if (empty($image_url) || $image_url === 'null') {
                $image_url = asset('asset/news_dummy_image.png');
            }

            $firstNews = $d;
            $firstNews['image_url'] = $image_url;
        }
        return view('news.index', compact('firstNews'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = $this->getFetchNews_Array();
        $news = $data->firstWhere('article_id', $id);
         
        return view('news.show', compact('news'));
    }
}
