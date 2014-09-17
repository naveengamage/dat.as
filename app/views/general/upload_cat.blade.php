@extends('layouts.master')
@section('content')
<style>
label{
    float: left;
    width: 113px;
    line-height: 200%;
  }

</style>
<div class="margauto width900px">
    <h1>Upload File: <span>Enter Links</span></h1>
    <div id="requestStatus" class="goodalertfield" style="display:none;"></div>
    <center><img src="//kastatic.com/images/indicator.gif" id="progress" style="display:none"></center>
    <div id="output" class="correctTorrent">
        <p class="accentbox botmarg20px">
            <strong>Warning!</strong><br />
            When you upload any kind of content to our website you take full responsibility for it's copyright and confirm that you are either the owner of this content or have the exclusive rights to distribute it.
            <br /><br />
        </p>
		<div class="halvedBlock">
			<h2>For the manual upload</h2><br />
    <div class="my-form">
        <form role="form" method="post">
            <p class="text-box">
                <a class="siteButton bigButton add-box" style="display:none;">Add More</a>
            </p>            
			<p class="host-box">
						<table class="achTable">
							<tbody>
								<tr>
									<td> 
										<a class="siteButton bigButton add-st" data-host="Streaming Link:" href="#">Add Streaming Link</a>
										<a class="siteButton bigButton add-dl" data-host="Download Link:" href="#">Add Download Link</a>
									</td>
								</tr>
							</tbody>
						</table>

            </p>
            <p><input type="submit" class="siteButton bigButton submit-box" style="display:none;" value="Submit" /></p>
        </form>
    </div>
		</div>
		<div class="halvedBlock">
            <p>If you want to get upload api access, better search positions (and a cool icon:) just ask us  and become a verified uploader!
			<a onclick="alert('You need to upload at least 20 posts, before you ask for the verification.');">Verify me as uploader</a><p>
        </div>
    </div>
</div>



<script type="text/javascript">
jQuery(document).ready(function($){
    $('.my-form .text-box .add-box').click(function(){
		$('.achTable').show();
    });   
    $('.achTable tr td').on('click', '.add-dl', function(){
		$('.customfile-feedback').hide();
        var box_html = $('<p class="text-box"><label for="box' + n + '"><span class="box-host">Download Link:</span></label> <input type="text" style="width: 200px;" name="dl_links[]" value="" id="box' + n + '" /> <a href="#" class="siteButton bigButton remove-box">Remove</a></p>');
        box_html.hide();
        $('.my-form p.text-box:last').before(box_html);
        box_html.fadeIn('slow');
		var n = $('.text-box').length;
        if( 10 < n ) {
			$('.achTable').hide();
			$('.my-form .add-box').hide();
        }else{
			$('.achTable').hide();
			$('.my-form .add-box').show();
		}
		$('.submit-box').show();
        return false;
    });    
	
	$('.achTable tr td').on('click', '.add-st', function(){
		$('.customfile-feedback').hide();
        var box_html = $('<p class="text-box"><label for="box' + n + '"><span class="box-host">Streaming Link:</span></label> <input type="text" style="width: 200px;" name="sm_links[]" value="" id="box' + n + '" /> <a href="#" class="siteButton bigButton remove-box">Remove</a></p>');
        box_html.hide();
        $('.my-form p.text-box:last').before(box_html);
        box_html.fadeIn('slow');
		var n = $('.text-box').length;
        if( 10 < n ) {
			$('.achTable').hide();
			$('.my-form .add-box').hide();
        }else{
			$('.achTable').hide();
			$('.my-form .add-box').show();
		}
		$('.submit-box').show();
        return false;
    });
	
    $('.my-form').on('click', '.remove-box', function(){
        $(this).parent().fadeOut("slow", function() {
            $(this).remove();
            $('.box-number').each(function(index){
                $(this).text( index + 1 );
            });
        });
		
		var n = $('.text-box').length;
		if( 3 > n ) {
			$('.submit-box').hide();
			$('.customfile-feedback').hide();
			$('.my-form .add-box').hide();
			$('.achTable').show();
		}else{
			$('.my-form .add-box').show();
		}
        return false;
    });
});
</script>
@stop