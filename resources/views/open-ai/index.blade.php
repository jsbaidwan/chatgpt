@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ChatGPT</div>

                <div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label><b>Response</b></label>
								
								<textarea rows="20" class="content" id="o-body" readonly></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								
								<textarea rows="5" class="body" placeholder="Ask me...." id="body"></textarea>
								<span class="b-err"></span>
							</div>
							
						</div>
						<div class="col-md-12">
							<div class="form-group">
								 <a href="javascript:void(0)" class="btn btn-success sbt-btn" onCLick="sOpenAi()"><span class="sbt-btn-text">Submit</span></a>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<style>
textarea { 
  width: 100%; 
  margin: 0; 
  padding: 0; 
  border-width: 0; 
    
}
textarea.body { 
   
  border:2px solid
}
</style>
<script>
function sOpenAi()
{
	var url = "<?php echo Url('open-ai'); ?>"
	var token = "<?php echo csrf_token(); ?>"
	var body = $('#body').val();
	$('.b-err').html('')
	  
	$('.sbt-btn-text').html('Loading....')
	$('.sbt-btn').prop('disabled',true)
	
	// document.getElementById("o-body").innerHTML += '\n\n'+body+'\n'
	$.ajax({
		url: url,
		method: 'POST',
		data: {"_method": 'POST', "_token" : token,'body':body},
		dataType: 'json',
		error:function(){
			 $('.sbt-btn-text').html('Submit')
			 $('.sbt-btn').prop('disabled',false)
		},
		success: function(response){ 
			$('.sbt-btn-text').html('Submit')
			$('.sbt-btn').prop('disabled',false)
			  
		   if(response.status == 200){
				//$('#o-body').html(response.html); 
				// $('#o-body').append('<br><br><b>'+body+'</b><br><br>');
				//$('#o-body').append(response.html);

				document.getElementById("o-body").innerHTML +='\n\n'+response.html+'\n\n'
				$('#body').val('')
				var $text = $('#o-body');
				$text.scrollTop($text[0].scrollHeight);
		   }else if(response.status == 422){
			   $('.b-err').html('<font color="red">'+response.message+'</font>')
		   }
			
		}
	})
}
</script>
