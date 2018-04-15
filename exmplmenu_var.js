/***********************************************************************************
*	(c) Ger Versluis 2000 version 5.411 24 December 2001 (updated Jan 31st, 2003 by Dynamic Drive for Opera7)
*	For info write to menus@burmees.nl		          *
*	You may remove all comments for faster loading	          *		
***********************************************************************************/

	var NoOffFirstLineMenus=5;			// Number of first level items
	var LowBgColor='#FFFFAA';			// Background color when mouse is not over
	var LowSubBgColor='#FCCFA2';			// Background color when mouse is not over on subs
	var HighBgColor='#9A9CFC';			// Background color when mouse is over
	var HighSubBgColor='#9A9CFC';			// Background color when mouse is over on subs
	var FontLowColor='black';			// Font color when mouse is not over
	var FontSubLowColor='black';			// Font color subs when mouse is not over
	var FontHighColor='white';			// Font color when mouse is over
	var FontSubHighColor='white';			// Font color subs when mouse is over
	var BorderColor='#BCBCBC';			// Border color
	var BorderSubColor='#BCBCBC';			// Border color for subs
	var BorderWidth=1;				// Border width
	var BorderBtwnElmnts=1;			// Border between elements 1 or 0
	var FontFamily="arial,comic sans ms,technical"	// Font family menu items
	var FontSize=9;				// Font size menu items
	var FontBold=1;				// Bold menu items 1 or 0
	var FontItalic=0;				// Italic menu items 1 or 0
	var MenuTextCentered='left';			// Item text position 'left', 'center' or 'right'
	var MenuCentered='left';			// Menu horizontal position 'left', 'center' or 'right'
	var MenuVerticalCentered='top';		// Menu vertical position 'top', 'middle','bottom' or static
	var ChildOverlap=.2;				// horizontal overlap child/ parent
	var ChildVerticalOverlap=.2;			// vertical overlap child/ parent
	var StartTop=100;				// Menu offset x coordinate
	var StartLeft=60;				// Menu offset y coordinate
	var VerCorrect=0;				// Multiple frames y correction
	var HorCorrect=0;				// Multiple frames x correction
	var LeftPaddng=3;				// Left padding
	var TopPaddng=2;				// Top padding
	var FirstLineHorizontal=1;			// SET TO 1 FOR HORIZONTAL MENU, 0 FOR VERTICAL
	var MenuFramesVertical=1;			// Frames in cols or rows 1 or 0
	var DissapearDelay=100;			// delay before menu folds in
	var TakeOverBgColor=1;			// Menu frame takes over background color subitem frame
	var FirstLineFrame='navig';			// Frame where first level appears
	var SecLineFrame='space';			// Frame where sub levels appear
	var DocTargetFrame='space';			// Frame where target documents appear
	var TargetLoc='';				// span id for relative positioning
	var HideTop=0;				// Hide first level when loading new document 1 or 0
	var MenuWrap=1;				// enables/ disables menu wrap 1 or 0
	var RightToLeft=0;				// enables/ disables right to left unfold 1 or 0
	var UnfoldsOnClick=0;			// Level 1 unfolds onclick/ onmouseover
	var WebMasterCheck=0;			// menu tree checking on or off 1 or 0
	var ShowArrow=0;				// Uses arrow gifs when 1
	var KeepHilite=1;				// Keep selected path highligthed
	var Arrws=['tri.gif',5,10,'tridown.gif',10,5,'trileft.gif',5,10];	// Arrow source, width and height

function BeforeStart(){return}
function AfterBuild(){return}
function BeforeFirstOpen(){return}
function AfterCloseAll(){return}


// Menu tree
//	MenuX=new Array(Text to show, Link, background image (optional), number of sub elements, height, width);
//	For rollover images set "Text to show" to:  "rollover:Image1.jpg:Image2.jpg"

Menu1=new Array("Enrollment","student.php","",9,20,138);
	Menu1_1=new Array("Create Student / Add Course","student.php","",0,20,180);	
	Menu1_2=new Array("Edit Student Profile","student_edit.php","",0,20,180);	
	Menu1_3=new Array("Post Dated Cheques","payment_schedule.php","",0);
	Menu1_4=new Array("Terminate Course","terminate_course.php","",0,20,180);	
	Menu1_5=new Array("Teacher Profile","teacher.php","",0);
	Menu1_6=new Array("Teacher Rates","teacher_rates.php","",0);
	Menu1_7=new Array("Course List","course_list.php","",0);
	Menu1_8=new Array("Change Password","change_password.php","",0);
	Menu1_9=new Array("Log Out","logout.php","",0);
Menu2=new Array("Class Scheduling","class_schedule.php","",6);
	Menu2_1=new Array("Class Schedule","class_schedule.php","",0,20,180);	
	Menu2_2=new Array("Add Classes","add_classes.php","",0);
	Menu2_3=new Array("Bulk Cancel","bulk_cancel.php","",0);
	Menu2_4=new Array("Bulk Changes","bulk_changes.php","",0);
	Menu2_5=new Array("Course Details","course_details.php","",0);
	Menu2_6=new Array("Holidays","Holiday.php","",0);
Menu3=new Array("Financials","adhoc_payments.php","",4);
	Menu3_1=new Array("Ad-hoc Payments","adhoc_payments.php","",0,20,180);
	Menu3_2=new Array("Other Fees","misc_items.php","",0);
	Menu3_3=new Array("Balance Report","balance_report.php","",0);
	Menu3_4=new Array("Teacher Advanced Payment","teacher_payments.php","",0);
Menu4=new Array("Month End","cheque_deposit.php","",3);
	Menu4_1=new Array("Cheque Deposit","cheque_deposit.php","",0,20,180);
	Menu4_2=new Array("Group Lesson & Other Income","teacher_group_lessons.php","",0);
	Menu4_3=new Array("Teacher's Payroll","teacher_payroll.php","",0);
Menu5=new Array("Reporting","reporting_menu.php","",9);
	Menu5_1=new Array("Outstanding Accounts","outstanding_accounts.php","",0,20,230);
	Menu5_2=new Array("Outstanding W/T Balance","outstanding_wt_balance.php","",0,20,230);
	Menu5_3=new Array("Daily Ad-hoc Payments (Excel)","reporting_menu.php","",0,20,230);
	Menu5_4=new Array("Teachers Report (Excel)","reporting_menu.php","",0,20,180);
	Menu5_5=new Array("Student List by Teacher (Excel)","reporting_menu.php","",0,20,180);
	Menu5_6=new Array("Related Students  (Excel)","reporting_menu.php","",0,20,230);
	Menu5_7=new Array("Teachers Pay History (Excel)","reporting_menu.php","",0,20,230);
	Menu5_8=new Array("Blank School Calendar","phpcalendar.php","",0,20,180);
	Menu5_9=new Array("Tax Receipt (Excel)","reporting_menu.php","",0,20,180);
