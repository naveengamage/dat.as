@extends('layouts.master')
@section('content')


<div class="margauto width900px textcontent">

	<br>
	<h2><a href="/movies/">Movies</a>
		<div class="smallButtonsline">
			
						<a class="siteButton smallButton" href="/movies/genre/"><span>by genre</span></a>
				<a class="siteButton smallButton" href="/movies/actors/"><span>by actor</span></a>
				&nbsp;
		</div>
	</h2>

	<div class="botmarg10px">
		<h5 class="lightgrey">By categories:</h5>
			<a class="plain" href="/3d-movies/">3D Movies</a>, 	   
			<a class="plain" href="/music-videos/">Music videos</a>, 	   
			<a class="plain" href="/movie-clips/">Movie clips</a>, 	   
			<a class="plain" href="/handheld-movies/">Handheld</a>, 	   
			<a class="plain" href="/ipad-movies/">iPad</a>, 	    
			<a class="plain" href="/highres-movies/">Highres Movies</a>, 	   
			<a class="plain" href="/bollywood/">Bollywood</a>, 	    
			<a class="plain" href="/concerts/">Concerts</a>, 	    
			<a class="plain" href="/dubbed-movies/">Dubbed Movies</a>, 	    
			<a class="plain" href="/asian/">Asian</a>, 	    
			<a class="plain" href="/documentary/">Documentary</a>, 	   
			<a class="plain" href="/trailer/">Trailer</a>, 	    
			<a class="plain" href="/other-movies/">Other Movies</a>	<br>

		<h5 class="lightgrey">By tags:</h5>
			<a class="plain" title="15395" href="/movies/genre/action/">Action</a>,     		
			<a class="plain" title="8" href="/movies/genre/adult/">Adult</a>,     		
			<a class="plain" title="10311" href="/movies/genre/adventure/">Adventure</a>,     		
			<a class="plain" title="4209" href="/movies/genre/animation/">Animation</a>,     		
			<a class="plain" title="1604" href="/movies/genre/biography/">Biography</a>,     		
			<a class="plain" title="16375" href="/movies/genre/comedy/">Comedy</a>,     		
			<a class="plain" title="8933" href="/movies/genre/crime/">Crime</a>,     		
			<a class="plain" title="3902" href="/movies/genre/documentary/">Documentary</a>,     	
			<a class="plain" title="24968" href="/movies/genre/drama/">Drama</a>,     		
			<a class="plain" title="6342" href="/movies/genre/family/">Family</a>,     		
			<a class="plain" title="7395" href="/movies/genre/fantasy/">Fantasy</a>,     		
			<a class="plain" title="210" href="/movies/genre/film-noir/">Film Noir</a>,     		
			<a class="plain" title="41" href="/movies/genre/game-show/">Game Show</a>,     		
			<a class="plain" title="1958" href="/movies/genre/history/">History</a>,     	
			<a class="plain" title="8272" href="/movies/genre/horror/">Horror</a>,     	
			<a class="plain" title="2379" href="/movies/genre/music/">Music</a>,     	
			<a class="plain" title="1227" href="/movies/genre/musical/">Musical</a>,     
			<a class="plain" title="5393" href="/movies/genre/mystery/">Mystery</a>,     	
			<a class="plain" title="60" href="/movies/genre/news/">News</a>,     		
			<a class="plain" title="131" href="/movies/genre/reality-tv/">Reality Tv</a>,    
			<a class="plain" title="9733" href="/movies/genre/romance/">Romance</a>,     	
			<a class="plain" title="7400" href="/movies/genre/sci-fi/">Sci Fi</a>,     	
			<a class="plain" title="2760" href="/movies/genre/short/">Short</a>,     	
			<a class="plain" title="1352" href="/movies/genre/sport/">Sport</a>,     
			<a class="plain" title="57" href="/movies/genre/talk-show/">Talk Show</a>, 
    		<a class="plain" title="18752" href="/movies/genre/thriller/">Thriller</a>, 
    		<a class="plain" title="2850" href="/movies/genre/war/">War</a>,     	
			<a class="plain" title="1402" href="/movies/genre/western/">Western</a>   
	</div>

	<br>
	
	<h2><a href="/tv/">TV</a>
		<div class="smallButtonsline">
			<a class="siteButton smallButton" href="/tv/show/"><span>by show</span></a>
			<a class="siteButton smallButton" href="/tv/genre/"><span>by genre</span></a>
		</div>
	</h2>

	<div class="botmarg10px">
		<h5 class="lightgrey">By tags:</h5>
			<a class="plain" title="1839" href="/tv/genre/action/">Action</a>,      		
			<a class="plain" title="1486" href="/tv/genre/adventure/">Adventure</a>,      		
			<a class="plain" title="476" href="/tv/genre/animation-general/">Animation General</a>,      	
			<a class="plain" title="147" href="/tv/genre/animation-general/">Animation-General</a>,     
			<a class="plain" title="630" href="/tv/genre/anime/">Anime</a>,      	
			<a class="plain" title="206" href="/tv/genre/anthology/">Anthology</a>,      	
			<a class="plain" title="1156" href="/tv/genre/celebrities/">Celebrities</a>,     
			<a class="plain" title="833" href="/tv/genre/children/">Children</a>,      	
			<a class="plain" title="138" href="/tv/genre/children-cartoons/">Children Cartoons</a>,     
			<a class="plain" title="3575" href="/tv/genre/comedy/">Comedy</a>,      	
			<a class="plain" title="292" href="/tv/genre/cooking-food/">Cooking Food</a>,      	
			<a class="plain" title="201" href="/tv/genre/cooking-food/">Cooking-Food</a>,      	
			<a class="plain" title="1215" href="/tv/genre/crime/">Crime</a>,      
			<a class="plain" title="314" href="/tv/genre/discovery-science/">Discovery Science</a>,      
			<a class="plain" title="252" href="/tv/genre/discovery-science/">Discovery-Science</a>,    
			<a class="plain" title="4041" href="/tv/genre/drama/">Drama</a>,      		
			<a class="plain" title="1076" href="/tv/genre/educational/">Educational</a>,      	
			<a class="plain" title="4051" href="/tv/genre/family/">Family</a>,      	
			<a class="plain" title="422" href="/tv/genre/fantasy/">Fantasy</a>,      	
			<a class="plain" title="875" href="/tv/genre/history/">History</a>,      
			<a class="plain" title="222" href="/tv/genre/horror-supernatural/">Horror Supernatural</a>,
			<a class="plain" title="287" href="/tv/genre/how-to-do-it-yourself/">How To Do It Yourself</a>,   
			<a class="plain" title="235" href="/tv/genre/how-to-do-it-yourself/">How-To-Do-It-Yourself</a>,  
			<a class="plain" title="389" href="/tv/genre/interview/">Interview</a>,      
			<a class="plain" title="1760" href="/tv/genre/lifestyle/">Lifestyle</a>,     
			<a class="plain" title="247" href="/tv/genre/medical/">Medical</a>,      
			<a class="plain" title="181" href="/tv/genre/military-war/">Military War</a>,   
			<a class="plain" title="137" href="/tv/genre/military-war/">Military-War</a>,   
			<a class="plain" title="890" href="/tv/genre/music/">Music</a>,     
			<a class="plain" title="663" href="/tv/genre/mystery/">Mystery</a>,      	
			<a class="plain" title="166" href="/tv/genre/politics/">Politics</a>,      
			<a class="plain" title="346" href="/tv/genre/romance-dating/">Romance Dating</a>,     
			<a class="plain" title="339" href="/tv/genre/romance-dating/">Romance-Dating</a>,    
			<a class="plain" title="545" href="/tv/genre/sci-fi/">Sci Fi</a>,      	
			<a class="plain" title="327" href="/tv/genre/sketch-improv/">Sketch Improv</a>,    
			<a class="plain" title="265" href="/tv/genre/soaps/">Soaps</a>,      	
			<a class="plain" title="735" href="/tv/genre/sports/">Sports</a>, 
			<a class="plain" title="903" href="/tv/genre/talent/">Talent</a>,      
			<a class="plain" title="319" href="/tv/genre/teens/">Teens</a>,   
			<a class="plain" title="428" href="/tv/genre/thriller/">Thriller</a>, 
			<a class="plain" title="632" href="/tv/genre/travel/">Travel</a>,     
			<a class="plain" title="222" href="/tv/genre/wildlife/">Wildlife</a>     
	</div>

	<br>
	<h2><a href="/music/">Music</a>
		<div class="smallButtonsline"></div>
	</h2>

	<div class="botmarg10px">
		<h5 class="lightgrey">By categories:</h5>
			<a class="plain" href="/mp3/">Mp3</a>,
			<a class="plain" href="/aac/">AAC</a>, 
			<a class="plain" href="/lossless/">Lossless</a>, 
			<a class="plain" href="/transcode/">Transcode</a>, 
			<a class="plain" href="/soundtrack/">Soundtrack</a>, 
			<a class="plain" href="/other-music/">Other Music</a>	<br>
	</div>

	<br>
	<h2><a href="/games/">Games</a>
		<div class="smallButtonsline"></div>
	</h2>

	<div class="botmarg10px">
		<h5 class="lightgrey">By categories:</h5>
				<a class="plain" href="/pc-games/">PC</a>, 
				<a class="plain" href="/mac-games/">Mac</a>,
				<a class="plain" href="/ps2/">PS2</a>, 	
				<a class="plain" href="/xbox360/">XBOX360</a>, 	
				<a class="plain" href="/xbox-one/">Xbox ONE</a>, 	
				<a class="plain" href="/wii/">Wii</a>, 		
				<a class="plain" href="/handheld-games/">Handheld</a>, 
				<a class="plain" href="/nds/">NDS</a>, 	
				<a class="plain" href="/psp/">PSP</a>, 	
				<a class="plain" href="/ps3/">PS3</a>, 	
				<a class="plain" href="/ps4/">PS4</a>, 	
				<a class="plain" href="/ps-vita/">PS Vita</a>, 	
				<a class="plain" href="/ios-games/">iOS</a>, 	
				<a class="plain" href="/android-games/">Android</a>, 
				<a class="plain" href="/other-games/">Other Games</a>	
	</div>

	<br>
	<h2><a href="/applications/">Applications</a>
		<div class="smallButtonsline"></div>
	</h2>

	<div class="botmarg10px">
		<h5 class="lightgrey">By categories:</h5>
				<a class="plain" href="/windows/">Windows</a>,
				<a class="plain" href="/mac-software/">Mac</a>, 	
				<a class="plain" href="/unix/">UNIX</a>, 		
				<a class="plain" href="/ios/">iOS</a>, 		
				<a class="plain" href="/android/">Android</a>, 		
				<a class="plain" href="/handheld-applications/">Handheld</a>, 
				<a class="plain" href="/other-applications/">Other Applications</a>
	</div>

	<br>
	<h2><a href="/books/">Books</a>
		<div class="smallButtonsline"></div>
	</h2>

	<div class="botmarg10px">
		<h5 class="lightgrey">By categories:</h5>
			<a class="plain" href="/ebooks/">Ebooks</a>, 
			<a class="plain" href="/comics/">Comics</a>, 	
			<a class="plain" href="/magazines/">Magazines</a>, 	 
			<a class="plain" href="/textbooks/">Textbooks</a>, 	  
			<a class="plain" href="/fiction/">Fiction</a>, 	    
			<a class="plain" href="/non-fiction/">Non-fiction</a>, 	
			<a class="plain" href="/audio-books/">Audio books</a>, 	 
			<a class="plain" href="/academic/">Academic</a>, 	
			<a class="plain" href="/other-books/">Other Books</a>	<br>
		<h5 class="lightgrey">By tags:</h5>
			<a class="plain" href="/books/genre/arts_photography/">Arts Photography</a>,  
			<a class="plain" href="/books/genre/biographies_memoirs/">Biographies Memoirs</a>,   
			<a class="plain" href="/books/genre/business_investing/">Business Investing</a>,        
			<a class="plain" href="/books/genre/childrens_books/">Childrens Books</a>,     
			<a class="plain" href="/books/genre/childrens_books_science_fiction_fantasy_mys/">Childrens Books Science Fiction Fantasy Mys</a>,     
			<a class="plain" href="/books/genre/comics_graphic_novels/">Comics Graphic Novels</a>,       
			<a class="plain" href="/books/genre/comics_graphic_novels_manga/">Comics Graphic Novels Manga</a>,  
			<a class="plain" href="/books/genre/comics_graphic_novels_publishers_dc/">Comics Graphic Novels Publishers Dc</a>,    
			<a class="plain" href="/books/genre/comics_graphic_novels_publishers_marvel/">Comics Graphic Novels Publishers Marvel</a>,
			<a class="plain" href="/books/genre/comics_graphic_novels_science_fiction/">Comics Graphic Novels Science Fiction</a>,   
			<a class="plain" href="/books/genre/comics_graphic_novels_superheroes/">Comics Graphic Novels Superheroes</a>,     
			<a class="plain" href="/books/genre/computers_internet/">Computers Internet</a>,       
			<a class="plain" href="/books/genre/computers_internet_programming/">Computers Internet Programming</a>,  
			<a class="plain" href="/books/genre/cooking_food_wine/">Cooking Food Wine</a>,      
			<a class="plain" href="/books/genre/education_reference/">Education Reference</a>,      
			<a class="plain" href="/books/genre/electronic_books/">Electronic Books</a>,         
			<a class="plain" href="/books/genre/fiction/">Fiction</a>,    
			<a class="plain" href="/books/genre/fiction_classics/">Fiction Classics</a>,     
			<a class="plain" href="/books/genre/fiction_contemporary/">Fiction Contemporary</a>,      
			<a class="plain" href="/books/genre/fiction_genre_action_adventure/">Fiction Genre Action Adventure</a>,   
			<a class="plain" href="/books/genre/fiction_genre_historical/">Fiction Genre Historical</a>,        
			<a class="plain" href="/books/genre/fiction_genre_horror/">Fiction Genre Horror</a>,    
			<a class="plain" href="/books/genre/fiction_literary/">Fiction Literary</a>,        
			<a class="plain" href="/books/genre/health_mind_body/">Health Mind Body</a>,        
			<a class="plain" href="/books/genre/health_mind_body_psychology_counseling/">Health Mind Body Psychology Counseling</a>,     
			<a class="plain" href="/books/genre/history_world/">History World</a>,       
			<a class="plain" href="/books/genre/home_garden_crafts_hobbies/">Home Garden Crafts Hobbies</a>,      
			<a class="plain" href="/books/genre/love_stories/">Love Stories</a>,      
			<a class="plain" href="/books/genre/medicine/">Medicine</a>,       
			<a class="plain" href="/books/genre/mystery_thrillers/">Mystery Thrillers</a>,     
			<a class="plain" href="/books/genre/mystery_thriller_suspense_thrillers/">Mystery Thriller Suspense Thrillers</a>,  
			<a class="plain" href="/books/genre/nonfiction_education/">Nonfiction Education</a>,     
			<a class="plain" href="/books/genre/nonfiction_social_sciences/">Nonfiction Social Sciences</a>, 
			<a class="plain" href="/books/genre/professional_technical_engineering/">Professional Technical Engineering</a>,      
			<a class="plain" href="/books/genre/reference/">Reference</a>,    
			<a class="plain" href="/books/genre/religion_spirituality/">Religion Spirituality</a>,     
			<a class="plain" href="/books/genre/romance/">Romance</a>,      
			<a class="plain" href="/books/genre/romance_contemporary/">Romance Contemporary</a>,    
			<a class="plain" href="/books/genre/science/">Science</a>,     
			<a class="plain" href="/books/genre/science_fiction_fantasy/">Science Fiction Fantasy</a>,       
			<a class="plain" href="/books/genre/teens/">Teens</a>,       
			<a class="plain" href="/books/genre/teens_science_fiction_fantasy/">Teens Science Fiction Fantasy</a>   
	</div>

	<br>
	<h2><a href="/anime/">Anime</a>
		<div class="smallButtonsline"></div>
	</h2>

	<div class="botmarg10px">
		<h5 class="lightgrey">By genres:</h5>
		<a class="plain" href="/anime/genre/action/">Action</a>, 
		<a class="plain" href="/anime/genre/adventure/">Adventure</a>,
		<a class="plain" href="/anime/genre/angst/">Angst</a>,
		<a class="plain" href="/anime/genre/asia/">Asia</a>, 
		<a class="plain" href="/anime/genre/calling-your-attacks/">Calling Your Attacks</a>,
		<a class="plain" href="/anime/genre/comedy/">Comedy</a>, 
		<a class="plain" href="/anime/genre/coming-of-age/">Coming Of Age</a>, 
		<a class="plain" href="/anime/genre/contemporary-fantasy/">Contemporary Fantasy</a>, 
		<a class="plain" href="/anime/genre/daily-life/">Daily Life</a>,
		<a class="plain" href="/anime/genre/earth/">Earth</a>, 
		<a class="plain" href="/anime/genre/ecchi/">Ecchi</a>, 
		<a class="plain" href="/anime/genre/fantasy/">Fantasy</a>, 
		<a class="plain" href="/anime/genre/fantasy-world/">Fantasy World</a>, 
		<a class="plain" href="/anime/genre/future/">Future</a>,
		<a class="plain" href="/anime/genre/game/">Game</a>, 
		<a class="plain" href="/anime/genre/harem/">Harem</a>, 
		<a class="plain" href="/anime/genre/high-school/">High School</a>, 
		<a class="plain" href="/anime/genre/japan/">Japan</a>, 
		<a class="plain" href="/anime/genre/magic/">Magic</a>,
		<a class="plain" href="/anime/genre/manga/">Manga</a>, 
		<a class="plain" href="/anime/genre/martial-arts/">Martial Arts</a>, 
		<a class="plain" href="/anime/genre/mecha/">Mecha</a>, 
		<a class="plain" href="/anime/genre/military/">Military</a>,
		<a class="plain" href="/anime/genre/new/">New</a>, 
		<a class="plain" href="/anime/genre/novel/">Novel</a>,
		<a class="plain" href="/anime/genre/nudity/">Nudity</a>,
		<a class="plain" href="/anime/genre/past/">Past</a>, 
		<a class="plain" href="/anime/genre/piloted-robot/">Piloted Robot</a>, 
		<a class="plain" href="/anime/genre/plot-continuity/">Plot Continuity</a>, 
		<a class="plain" href="/anime/genre/present/">Present</a>, 
		<a class="plain" href="/anime/genre/romance/">Romance</a>, 
		<a class="plain" href="/anime/genre/school-life/">School Life</a>,
		<a class="plain" href="/anime/genre/sci-fi/">Sci-Fi</a>, 
		<a class="plain" href="/anime/genre/seinen/">Seinen</a>, 
		<a class="plain" href="/anime/genre/shoujo/">Shoujo</a>,
		<a class="plain" href="/anime/genre/shounen/">Shounen</a>,
		<a class="plain" href="/anime/genre/slapstick/">Slapstick</a>, 
		<a class="plain" href="/anime/genre/stereotypes/">Stereotypes</a>, 
		<a class="plain" href="/anime/genre/super-power/">Super Power</a>, 
		<a class="plain" href="/anime/genre/swordplay/">Swordplay</a>,
		<a class="plain" href="/anime/genre/tragedy/">Tragedy</a>,
		<a class="plain" href="/anime/genre/violence/">Violence</a>
	</div>

	<br>
	<h2><a href="/other/">Other</a>
		<div class="smallButtonsline"></div>
	</h2>

	<div class="botmarg10px">
		<h5 class="lightgrey">By categories:</h5>
				<a class="plain" href="/pictures/">Pictures</a>, 	
				<a class="plain" href="/sound-clips/">Sound clips</a>, 	
				<a class="plain" href="/covers/">Covers</a>, 	
				<a class="plain" href="/wallpapers/">Wallpapers</a>, 		
				<a class="plain" href="/tutorials/">Tutorials</a>, 		
				<a class="plain" href="/unsorted/">Unsorted</a>
	</div>

	<br>
	<h2><a href="/xxx/">XXX</a>
		<div class="smallButtonsline"></div>
	</h2>

	<div class="botmarg10px">
		<h5 class="lightgrey">By categories:</h5>
				<a class="plain" href="/xxx-video/">Video</a>, 		
				<a class="plain" href="/xxx-hd-video/">HD Video</a>, 	
				<a class="plain" href="/xxx-pictures/">Pictures</a>, 	
				<a class="plain" href="/xxx-magazines/">Magazines</a>, 		
				<a class="plain" href="/xxx-books/">Books</a>, 			
				<a class="plain" href="/hentai/">Hentai</a>, 		
				<a class="plain" href="/other-xxx/">Other XXX</a>	
	</div>
</div>
 

@stop