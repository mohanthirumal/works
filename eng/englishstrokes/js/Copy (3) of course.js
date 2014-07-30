var course = new Course();
function Course()
{
	this.moveLength = 108;
	this.current = 0;
	this.resume = 0;
	this.previous = 0;
	this.previousPrev = 0;
	this.next = 2;
	this.activityCount = 0;
	this.currentActivity = 1;
	this.leftStatus = 'open';
	this.courseId = 1;
	this.currentPlayTimer = 0;
}
Course.prototype.goto = function(length)
{
	var topSize = $('.course-right-list').css('left');
	topSize = parseInt(topSize) + parseInt(length);
	$('.course-right-list').css('left', topSize+'%');
	
}
Course.prototype.gotoDirect = function(length)
{
	var topSize = $('.course-right-list').css('left');
	topSize = parseInt(length);
	$('.course-right-list').css('left', topSize+'%');
	
}
Course.prototype.getCurrent = function(position)
{
	var lessonId = course.current;
	//if(course.previousPrev == lessonId)
//	{
//		
//		course.currentActivity = 1;
//		course.activityCount = course.previousPrevActCount;
//		eng.jQuery('.course-activities').children('.course-lesson1').children('a').removeClass('active');
//		eng.jQuery('#lesson'+course.current+'link').children('.course-activities').children('.course-lesson1:nth-child('+course.currentActivity+')').children('a').addClass('active');
//		return false;
//	}
	if(course.previousPrev)
	{
		eng.jQuery('.lesson'+course.previousPrev+' .course-video-cont').html('');
		//eng.jQuery('#lesson'+course.previous).parent().next().html('').css('height', '0');
	}
	eng.jQuery.ajax({
		type: 'POST',  
		url: domainUrl+'wp-admin/admin-ajax.php',  
		data: {  
		  action: 'getLesson',  
		  id: lessonId
		},
		success: function(data, textStatus, XMLHttpRequest){
			var retur = JSON.parse(data);
			if(retur == 'error')
			{
				alert('You don\'t have permission to view this lesson');
				eng.jQuery('.course-unit:nth-child(1)').next().children('.course-lesson:nth-child(1)').children('a').click();
				eng.jQuery('.course-unit:nth-child(1)').click();
				return false;
			}
			eng.jQuery('#video'+lessonId).html(retur.video);
			var innerhtml = '';
			course.activityCount = 0
			if(retur.video)
				for(i = 0; i < retur.video.length; i++)
				{
					eng.jQuery('#video'+lessonId+retur.videoid[i]).html(retur.video[i]);
					course.activityCount++;
					//innerhtml += '<div class="course-right-indi"><div onclick="prevActivity()">Prev</div><div class="course-video-cont">'+retur.activity[i]+'</div><div onclick="nextActivity()">Next</div></div>';
				}
			if(retur.activity)
				for(i = 0; i < retur.activity.length; i++)
				{
					eng.jQuery('#activity'+lessonId+retur.activityid[i]).html(retur.activity[i]);
					course.activityCount++;
					//innerhtml += '<div class="course-right-indi"><div onclick="prevActivity()">Prev</div><div class="course-video-cont">'+retur.activity[i]+'</div><div onclick="nextActivity()">Next</div></div>';
				}
			if(position)
				course.currentActivity = position;
			else
				course.currentActivity = 1;
			course.previousPrev = course.previous;
			course.previous = course.current;
			//eng.jQuery('#lesson'+lessonId).parent().next().append(innerhtml).css('height', '100%');
			course.updateCurrentLink();
			if(course.currentPlayTimer != 0)
				clearTimeout(course.currentPlayTimer);
			course.currentPlayTimer = setTimeout(function(){course.updateUserPlay();}, 20000);
			return true;
		},
		error: function(MLHttpRequest, textStatus, errorThrown){  
			alert(errorThrown);
		}
	});
}
Course.prototype.init = function()
{
	eng.jQuery('.course-lesson a').unbind('click').click(function()
	{
		var rel = eng.jQuery(this).attr('rel');
		var lessonId = eng.jQuery(this).attr('lessonid');
		var getContent = true;
		var position = eng.jQuery(this).attr('position');
		//course.stopCurrentVideo();
		if(course.current == lessonId || course.previous == lessonId)
		{
			getContent = false;
			course.currentActivity = position;
		}
		course.current = lessonId;
		course.updateCurrentLink();
		var top = rel * -course.moveLength;
		eng.jQuery('.course-right-list').css('left', top+'%');
		if(getContent)
			course.getCurrent(position);
	});
	eng.jQuery('.course-next-lesson').click(function()
	{
		course.currentActivity++;
		course.updateCurrentLink();
		course.stopCurrentVideo();
		if(course.currentActivity > course.activityCount)
		{
			if(eng.jQuery('#lesson'+course.current+'link').next().children('a').attr('lessonid'))
				var rel = eng.jQuery('#lesson'+course.current+'link').next().children('a');
			else if(eng.jQuery('#lesson'+course.current+'link').parent().next().next().children('.course-lesson:nth-child(1)').children('a').attr('lessonid'))
				var rel = eng.jQuery('#lesson'+course.current+'link').parent().next().next().children('.course-lesson:nth-child(1)').children('a');
			else
				eng.jQuery('.course-unit:nth-child(1)').next().children('.course-lesson:nth-child(1)').children('a').click();
			course.current = rel.attr('lessonid');
			var top = (parseInt(rel.attr('rel'))-1) * -course.moveLength;
			course.gotoDirect(top);
			var afterStatus = parseInt(rel.attr('rel')) * -course.moveLength;
			course.getCurrent();
			setTimeout('course.gotoDirect('+afterStatus+')', 2000);
		}
		else
			course.goto(-course.moveLength);
	});
	eng.jQuery('.course-prev-lesson').click(function()
	{
		course.currentActivity--;
		course.updateCurrentLink();
		course.stopCurrentVideo();
		if(course.currentActivity < 1)
		{
			if(eng.jQuery('#lesson'+course.current+'link').prev().children('a').attr('lessonid'))
				var rel = eng.jQuery('#lesson'+course.current+'link').prev().children('a');
			else
				var rel = eng.jQuery('#lesson'+course.current+'link').parent().prev().prev().children('.course-lesson').last().children('a');
			course.currentActivity = 1;
			if(!rel.attr('rel'))
				return false;
			course.current = rel.attr('lessonid');
			eng.jQuery('#lesson'+course.current+'link').children('.course-activities').children('.course-lesson1:nth-child(1)').children('a').addClass('active');
			var top = rel.attr('rel') * -course.moveLength;
			course.gotoDirect(top);
			course.getCurrent();
		}
		else
			course.goto(course.moveLength);
	});
	eng.jQuery('.course-start-lecture').click(function()
	{
		eng.jQuery(this).parent().children('a').click();
	});
	eng.jQuery('.course-tab').click(function()
	{
		eng.jQuery('.course-tab').removeClass('active');
		eng.jQuery(this).addClass('active');
		var content = eng.jQuery(this).attr('rel')
		eng.jQuery('.course-tab-content').hide();
		eng.jQuery('#'+content).show();
	});
	eng.jQuery('.course-unit').click(function()
	{
		eng.jQuery('.course-unit').removeClass('active');
		eng.jQuery(this).addClass('active');
		eng.jQuery('.lessons').css({'height': '0px'});
		eng.jQuery('.lessons').children('.course-lesson').children('.course-progress-bar').hide();
		eng.jQuery('.lessons').children('.course-lesson').children('.course-locker').hide();
		eng.jQuery(this).next().children('.course-lesson').children('.course-progress-bar').delay(200).fadeIn();
		eng.jQuery(this).next().children('.course-lesson').children('.course-locker').delay(200).fadeIn();
		var length = eng.jQuery(this).next().children('.course-lesson').length;
		var height = length * 64;
		eng.jQuery(this).next().css({'height': height+'px'});
		
	});
	eng.jQuery('.course-locker').click(function()
	{
		eng.jQuery('.course-buy-popup').fadeIn();
	});
	eng.jQuery('.course-buy-popup-close').click(function()
	{
		eng.jQuery('.course-buy-popup').hide();
	});
	
	eng.jQuery('.close-note').live('click', function()
	{
		if(eng.jQuery(this).parent())
		if(!confirm('Are you sure! you want to remove the item permanently'))
			return false;
		eng.jQuery(this).parent().remove();
		course.updateUserNotes();
	});
	
	if(course.resume == 0)
	{
		eng.jQuery('.course-unit:nth-child(1)').next().children('.course-lesson:nth-child(1)').children('a').click();
		eng.jQuery('.course-unit:nth-child(1)').click();
	}
	else
	{
		eng.jQuery('#lesson'+course.resume+'link').children('a').click();
		eng.jQuery('#lesson'+course.resume+'link').parent().prev().click();
	}
	course.getUserNotes();
}
eng.jQuery(document).ready(function($){
	course.getDetails();
});
Course.prototype.updateCurrentLink = function()
{
	eng.jQuery('.course-activities').children('.course-lesson1').children('a').removeClass('active');
	eng.jQuery('#lesson'+course.current+'link').children('.course-activities').children('.course-lesson1:nth-child('+course.currentActivity+')').children('a').addClass('active');
	if(!eng.jQuery('#lesson'+course.current+'link').parent().prev().hasClass('active'))
		eng.jQuery('#lesson'+course.current+'link').parent().prev().click();
}
Course.prototype.closeLeftContainer = function()
{
	if(course.leftStatus == 'open')
	{
		eng.jQuery('.course-left').css('left', '-425px');
		eng.jQuery('.course-right').css('left', '40px');
		course.leftStatus = 'closed';
	}
	else
	{
		eng.jQuery('.course-left').css('left', '0');
		eng.jQuery('.course-right').css('left', '465px');
		course.leftStatus = 'open';
	}
}

Course.prototype.getDetails = function()
{
	var sidebarSource = eng.jQuery("#chapter-sidebar-template").html();
	var source = eng.jQuery("#chapter-template").html();
	var sidebarTemplate = Handlebars.compile(sidebarSource);
	var template = Handlebars.compile(source);
	eng.jQuery.ajax({
		type: 'POST',  
		url: domainUrl+'wp-admin/admin-ajax.php',  
		data: {  
		  action: 'getCourseDetails',  
		  id: course.courseId
		},
		success: function(data, textStatus, XMLHttpRequest){
			var data = JSON.parse(data);
			eng.jQuery('#course-tab-content1').append(sidebarTemplate(data));
			eng.jQuery('#course-right-list').append(template(data));
			course.init();
			eng.jQuery('.header,.footer,.loading').hide();
			eng.jQuery('.course-page').fadeIn();
		},
		error: function(MLHttpRequest, textStatus, errorThrown){  
			alert(errorThrown);
		}
	});
}

Course.prototype.updateUserPlay = function()
{
	eng.jQuery.ajax({
		type: 'POST',  
		url: domainUrl+'wp-admin/admin-ajax.php',  
		data: {  
		  action: 'updateUserPlay',  
		  id: course.current,
		  cid: course.courseId
		},
		success: function(data, textStatus, XMLHttpRequest){
		},
		error: function(MLHttpRequest, textStatus, errorThrown){  
			alert(errorThrown);
		}
	});
}
Course.prototype.stopCurrentVideo = function()
{
	if(document.getElementById('frame'+course.current) && course.current != 0)
		document.getElementById('frame'+course.current).contentWindow.stopVideo();
}

Handlebars.registerHelper('ifCond', function(v1, v2, options) {
  if(v1 === v2) {
    return options.fn(this);
  }
  return options.inverse(this);
});
Handlebars.registerHelper('add', function(v1, v2) {
  return v1 + v2;
});

Course.prototype.updateCourseNotes = function()
{
	var notes = eng.jQuery('#note').val();
	if(notes.trim().length == 0)
		return false;
	eng.jQuery('#course-notes').append('<li>'+notes+'<div class="close-note">x</div></li>');
	eng.jQuery('#note').val('');
	course.updateUserNotes();
	return false;
}

Course.prototype.updateUserNotes = function()
{
	var notes = eng.jQuery('#course-notes').html();
	eng.jQuery.ajax({
		type: 'POST',  
		url: domainUrl+'wp-admin/admin-ajax.php',  
		data: {  
		  action: 'updateUserNotes',  
		  notes: notes,
		  cid: course.courseId
		},
		success: function(data, textStatus, XMLHttpRequest){
		},
		error: function(MLHttpRequest, textStatus, errorThrown){  
			alert(errorThrown);
		}
	});
}

Course.prototype.getUserNotes = function()
{
	var notes = eng.jQuery('#course-notes').html();
	eng.jQuery.ajax({
		type: 'POST',  
		url: domainUrl+'wp-admin/admin-ajax.php',  
		data: {  
		  action: 'getUserNotes',
		  cid: course.courseId
		},
		success: function(data, textStatus, XMLHttpRequest){
			eng.jQuery('#course-notes').html(data);
		},
		error: function(MLHttpRequest, textStatus, errorThrown){  
			alert(errorThrown);
		}
	});
}

function updateActivityStatus(id)
{
	var lessonId = course.current;
	eng.jQuery.ajax({
		type: 'POST',  
		url: domainUrl+'wp-admin/admin-ajax.php',  
		data: {  
		  action: 'getCurrentLessonStatus',
		  cid: course.courseId,
		  id: lessonId
		},
		success: function(data, textStatus, XMLHttpRequest){
			var retur = JSON.parse(data);
			eng.jQuery('#lesson'+lessonId+'link .course-progress-bar .course-progress-bar-status').css('width', retur.current+'%');
			eng.jQuery('#lesson'+lessonId+'link .course-progress-bar .course-progress-bar-percent').text(retur.current+'%');
			eng.jQuery('.completion-ratio').text(retur.total+'%');
			eng.jQuery('.lessonact'+id).children('.course-completed-image').removeClass('course-incompleted-image');
		},
		error: function(MLHttpRequest, textStatus, errorThrown){  
			alert(errorThrown);
		}
	});
}