<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>{{route('home')}}</loc>
		<changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
	<url>
		<loc>{{route('about')}}</loc>
		<changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
	<url>
		<loc>{{route('contact-us')}}</loc>
	    <changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
	<url>
		<loc>{{route('history')}}</loc>
	    <changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
	<url>
		<loc>{{route('faq')}}</loc>
	    <changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
	<url>
		<loc>{{route('privacy-policy')}}</loc>
	    <changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
	<url>
		<loc>{{route('term-condition')}}</loc>
	    <changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
	<url>
		<loc>{{route('exchange')}}</loc>
	    <changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
	@foreach ($coin_pairs as $coin_pairs_result)
	<url>
		<loc>{{route('exchange-detail', ['slug' => $coin_pairs_result->slug])}}</loc>
		<lastmod>
             @if(!empty($coin_pairs_result->updated_at))
             {{ gmdate('Y-m-d\TH:i:s\Z',strtotime($coin_pairs_result->updated_at)) }}
             @else
             {{ gmdate('Y-m-d\TH:i:s\Z',strtotime($coin_pairs_result->created_at)) }}
             @endif
		 </lastmod>
		<changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
	@endforeach

	<url>
		<loc>{{route('how-it-works')}}</loc>
	    <changefreq>daily</changefreq>
		<priority>0.8</priority>
	</url>
</urlset>