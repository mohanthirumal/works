<?php
/**
 * Template Name: Course Study Page Template
 *
 * Description: Course page contains chapters of that course
 */
 get_header();
 global $current_user;
 if(!is_user_logged_in())
 	echo '<script>window.location.href=\'courses\'</script>';
?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/course.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/handlebars-v1.3.0.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/course.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jwplayer/jwplayer.js"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/css/sizing.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript">jwplayer.key="gKHyBuWb/9rWoQ5nzmFQ2pXpun3Guzd88iZrPWuCOsg=";</script>
	<div class="course-page">
		<!--<div class="course-buy-popup">
			<div class="course-buy-popup-text">Would you like to be our premium member, then you should buy the course</div>
			<div class="course-buy-popup-close"></div>
		</div>-->
		<div class="course-left">
			<div class="course-left-content">
				<div class="course-left-list">
					<div class="course-left-head">
						<div class="course-left-tab-list-bg active course-tab" rel="course-tab-content1">
							<div class="course-left-tab-list"></div>
						</div>
						<div class="course-left-tab-list-bg course-tab2 course-tab" rel="course-tab-content2">
							<div class="course-left-tab-chat"></div>
						</div>
						<div class="course-left-tab-list-bg course-tab3 course-tab" rel="course-tab-content3" style="margin:0;">
							<div class="course-left-tab-notes"></div>
						</div>
					</div>
					<script id="chapter-sidebar-template" type="text/x-handlebars-template">
					{{#each chapter}}
					<div class="course-unit">{{name}}</div>
					<div class="lessons">
						{{#each lesson}}
						<div class="course-lesson" id="lesson{{id}}link">
							<a class="course-lesson-link" href="#" rel="{{count}}" lessonid="{{id}}">{{name}}</a>
							{{#ifCond locked 'false'}}
							<div class="course-start-lecture">Play</div>
							{{/ifCond}}
							<div class="course-activities">
								{{#each video}}
								<div class="course-lesson1" id="video{{id}}link">
									<a href="#" rel="{{count}}" lessonid="{{lessonid}}" videoid="{{id}}" position="{{position}}">{{title}}</a>
								</div>
								{{/each}}
								{{#each activity}}
								<div class="course-lesson1" id="activity{{id}}link">
									<a href="#" rel="{{count}}" lessonid="{{lessonid}}" activityid="{{id}}" position="{{position}}">{{title}}</a>
								</div>
								{{/each}}
							</div>
							<div class="course-progress-bar" style="display: block;">
								<div class="course-progress-bar-status" style="width:{{complPerc}}%"></div>
								<div class="course-progress-bar-percent">{{complPerc}}%</div>
							</div>
							{{#ifCond locked 'true'}}
							<div class="course-locker"><div class="course-locker-icon"></div></div>
							{{/ifCond}}
						</div>
						{{/each}}
					</div>
					{{/each}}
					</script>
					<script id="chapter-template" type="text/x-handlebars-template">
					{{#each chapter}}
						{{#each lesson}}
							{{#each video}}
								<div class="course-right-indi lesson{{lessonid}} {{lessonCount}}">
									<div class="course-unit-display">
										<div class="course-unit-name">{{chapterName}}</div>
										<div class="course-unit-lesson-name">Lesson<span>{{lessonCount}}</span></div>
									</div>
									<div class="course-lesson-name">{{lessonName}}</div>
									<div class="course-video-cont" id="video{{lessonid}}{{id}}"></div>
									<div class="course-navigation">
										<div class="course-navigation-inner">
											<div class="course-prev-lesson">
												<div class="course-left-btn"></div>
												<div class="course-middle-btn">Prev</div>
												<div class="course-right-btn"></div>
											</div>
											<div class="course-prev-line"></div>
											
												<div class="course-left-back-to-btn">
													<a href="<?php bloginfo('url');?>/courses">
													<div style="margin:0 auto; width:129px;">
													<div class="course-left-btn"></div>
													<div class="course-middle-btn">Back to course</div>
													<div class="course-right-btn"></div>
													</div>
													</a>
												</div>
											
											<div class="course-next-line"></div>
											<div class="course-next-lesson">
												<div class="course-left-btn"></div>
												<div class="course-middle-btn">Next</div>
												<div class="course-right-btn"></div>
											</div>
										</div>
									</div>
								</div>
							{{/each}}
							{{#each activity}}
								<div class="course-right-indi lesson{{lessonid}} lessonact{{id}} {{lessonCount}}">
									<div class="course-unit-display">
										<div class="course-unit-name">{{chapterName}}</div>
										<div class="course-unit-lesson-name">Lesson<span>{{lessonCount}}</span></div>
									</div>
									<div class="course-lesson-name">{{lessonName}}</div>
									<div class="course-video-cont" id="activity{{lessonid}}{{id}}"></div>
									<div class="course-navigation">
										<div class="course-navigation-inner">
											<div class="course-prev-lesson">
												<div class="course-left-btn"></div>
												<div class="course-middle-btn">Prev</div>
												<div class="course-right-btn"></div>
											</div>
											<div class="course-prev-line"></div>
											
											<div class="course-left-back-to-btn">
												<a href="<?php bloginfo('url');?>/courses">
												<div style="margin:0 auto; width:129px;">
												<div class="course-left-btn"></div>
												<div class="course-middle-btn">Back to course</div>
												<div class="course-right-btn"></div>
												</div>
												</a>
											</div>
											
											<div class="course-next-line"></div>
											<div class="course-next-lesson">
												<div class="course-left-btn"></div>
												<div class="course-middle-btn">Next</div>
												<div class="course-right-btn"></div>
											</div>
										</div>
									</div>
									{{#ifCond completed 'true'}}
									<div class="course-completed-image"></div>
									{{else}}
									<div class="course-completed-image course-incompleted-image"></div>
									{{/ifCond}}
								</div>
							{{/each}}
							<div class="course-right-indi">
								<span class="percent completion-ratio">{{courseCompl}}%</span>
								<div class="note">
									<span>You have completed <b class="completion-ratio">{{courseCompl}}%</b> of this course</span>
								</div>
							</div>
						{{/each}}
					{{/each}}
					</script>
					<div class="course-left-body">
						<div class="course-tab-content" id="course-tab-content3">
							<div id="note-form">
								<form id="create-note-form" name="create-note-form" method="post" onsubmit="return course.updateCourseNotes()">
									<textarea id="note" name="note" placeholder="Start typing to take your note" style="height: 34px; overflow: hidden;" onkeydown="if (event.keyCode == 13) {course.updateCourseNotes();return false;}"></textarea>
								</form>
							</div>
							<div class="course-notes-upper">
								<ul class="course-notes" id="course-notes"></ul>
							</div>
						</div>
						<div class="course-tab-content" id="course-tab-content2"><h1 style="text-align:center">Coming Soon</h1></div>
						<div class="course-tab-content" id="course-tab-content1" style="display:block; overflow:auto">
							<?php
							if( is_page('level-1-beginner') )
								$id_course = 1;
							if( is_page('level-2-intermediate') )
								$id_course = 4;
							if( is_page('level-3-advanced') )
								$id_course = 5;
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="course-left-closer" onclick="course.closeLeftContainer()"></div>
		</div>
		<div class="course-right">
			<div class="course-right-list" id="course-right-list">
			
			</div>
		</div>
	</div>
	<div class="loading"></div>
	<script>
	course.courseId = '<?php echo $id_course;?>';
	<?php
	$current = json_decode(get_user_meta( $current_user->ID, 'user_course_resume', true ), true);
	if(count($current) > 0)
		echo 'course.resume = \''.$current[$id_course].'\';';
	?>
	</script>
<?php
get_footer();