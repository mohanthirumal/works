var course = new Course();
function nextActivity()
{
	course.currentActivity++;
	if(course.currentActivity > course.activityCount)
	{
		var rel = eng.jQuery('#lesson'+course.current+'link').next().children('a').attr('rel');
		var lessonId = eng.jQuery('#lesson'+course.current+'link').next().children('a').attr('lessonid');
		course.current = lessonId;
		var top = rel * -100;
		course.goto(top);
		course.getCurrent();
	}
	else
		course.goto(-100);
}

function prevActivity()
{
	course.goto(100);
}

function Course()
{
	this.current = 1;
	this.previous = 0;
	this.next = 2;
	this.activityCount = 1;
	this.currentActivity = 0;
}
Course.prototype.goto = function(length)
{
	var topSize = $('.course-right-list').css('left');
	topSize = parseInt(topSize) + parseInt(length);alert(topSize);
	$('.course-right-list').css('left', topSize+'%');
	
}
Course.prototype.getCurrent = function()
{
	if(course.previous)
	{
		eng.jQuery('#lesson'+course.previous).html('');
		eng.jQuery('#lesson'+course.previous).parent().next().html('').css('height', '0');
	}
	var lessonId = course.current;
	eng.jQuery.ajax({
		type: 'POST',  
		url: domainUrl+'wp-admin/admin-ajax.php',  
		data: {  
		  action: 'getLesson',  
		  id: lessonId
		},
		success: function(data, textStatus, XMLHttpRequest){
			var retur = JSON.parse(data);
			eng.jQuery('#video'+lessonId).html(retur.video);
			var innerhtml = '';
			for(i = 0; i < retur.activity.length; i++)
			{
				eng.jQuery('#activity'+retur.activityid[i]).html(retur.activity[i]);
				//innerhtml += '<div class="course-right-indi"><div onclick="prevActivity()">Prev</div><div class="course-video-cont">'+retur.activity[i]+'</div><div onclick="nextActivity()">Next</div></div>';
			}
			course.activityCount = retur.activity.length;
			course.currentActivity = 0;
			course.previous = lessonId;
			eng.jQuery('#lesson'+lessonId).parent().next().append(innerhtml).css('height', '100%');
		},
		error: function(MLHttpRequest, textStatus, errorThrown){  
			alert(errorThrown);
		}
	});
}
eng.jQuery(document).ready(function($)
{
	eng.jQuery('.course-lesson a').unbind('click').click(function()
	{
		var rel = eng.jQuery(this).attr('rel');
		var lessonId = eng.jQuery(this).attr('lessonid');
		course.current = lessonId;
		var top = rel * -100;
		eng.jQuery('.course-right-list').css('top', top+'%');
		course.getCurrent();
	});
});