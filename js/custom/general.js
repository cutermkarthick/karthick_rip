jQuery.noConflict();

jQuery(document).ready(function(){
	
	//search box of header
	jQuery('#keyword').bind('focusin focusout', function(e){
		var t = jQuery(this);
		if(e.type == 'focusin' && t.val() == 'Search here') {
			t.val('');
		} else if(e.type == 'focusout' && t.val() == '') {
			t.val('Search here');	
		}
	});
	
	
	//userinfo
	jQuery('.userinfo').click(function(){
		if(!jQuery(this).hasClass('userinfodrop')) {
			var t = jQuery(this);
			jQuery('.userdrop').width(t.width() + 30); //make this width the same with the user info wrapper
			jQuery('.userdrop').slideDown('fast');
			t.addClass('userinfodrop');					//add class to change color and background
			// alert("reached");
		} else {
			jQuery(this).removeClass('userinfodrop');
			jQuery('.userdrop').hide();
		}
		
		//remove notification box if visible
		jQuery('.notialert').removeClass('notiactive');
		jQuery('.notibox').hide();
			
		return false;
	});
	
	
	//notification onclick
	jQuery('.notialert').click(function(){
		var t = jQuery(this);
		var url = t.attr('href');
		if(!t.hasClass('notiactive')) {
			jQuery('.notibox').slideDown('fast');			//show notification box
			jQuery('.noticontent').empty();					//clear data
			jQuery('.notibox .tabmenu li').each(function(){ 
				jQuery(this).removeClass('current');		//reset active tab menu
			});
			//make first li as default active menu
			jQuery('.notibox .tabmenu li:first-child').addClass('current');
			
			t.addClass('notiactive');
			
			jQuery('.notibox .loader').show();				//show loading image while waiting a response from server
			jQuery.post(url,function(data){
				jQuery('.notibox .loader').hide();			//hide loader after response		 
				jQuery('.noticontent').append(data);		//append data from server to .noticontent box
			});
		} else {
			t.removeClass('notiactive');
			jQuery('.notibox').hide();
		}
		
		//this will hide user info drop down when visible
		jQuery('.userinfo').removeClass('userinfodrop');
		jQuery('.userdrop').hide();
		
		return false;
	});
	
	
	jQuery(document).click(function(event) {
		var ud = jQuery('.userdrop');
		var nb = jQuery('.notibox');
		
		//hide user drop menu when clicked outside of this element
		if(!jQuery(event.target).is('.userdrop') && ud.is(':visible')) {
			ud.hide();
			jQuery('.userinfo').removeClass('userinfodrop');
		}
		
		//hide notification box when clicked outside of this element
		if(!jQuery(event.target).is('.notibox') && nb.is(':visible')) {
			nb.hide();
			jQuery('.notialert').removeClass('notiactive');
		}
	});
	
	
	//notification box tab menu
	jQuery('.tabmenu a').click(function(){
		var url = jQuery(this).attr('href');
		
		//reset active menu
		jQuery('.tabmenu li').each(function(){
		// alert("REached");
			jQuery(this).removeClass('current');
		});
		
		jQuery('.noticontent').empty();					//empty content first to display new data
		jQuery('.notibox .loader').show();
		jQuery(this).parent().addClass('current');		//add current class to menu
		jQuery.post(url,function(data){
			jQuery('.notibox .loader').hide();			
			jQuery('.noticontent').append(data);		//inject new data from server
		});
		return false;
	});
	
	
	// Widget Box Title on Hover event
	// show arrow image in the right side of the title upon hover
	jQuery('.widgetbox .title').hover(function(){
		if(!jQuery(this).parent().hasClass('uncollapsible'))									   
			jQuery(this).addClass('titlehover');
	}, function(){
		jQuery(this).removeClass('titlehover');
	});
	
	//show/hide widget content when widget title is clicked
	jQuery('.widgetbox .title').click(function(){
		if(!jQuery(this).parent().hasClass('uncollapsible')) {									   
			if(jQuery(this).next().is(':visible')) {
				jQuery(this).next().slideUp('fast');
				jQuery(this).addClass('widgettoggle');
			} else {
				jQuery(this).next().slideDown('fast');
				jQuery(this).removeClass('widgettoggle');
			}
		}
	});
	
	//wrap menu to em when click will return to true
	//this code is required in order the code (next below this code) to work.
	jQuery('.leftmenu a span').each(function(){
		jQuery(this).wrapInner('<em />');
	});

	jQuery('.leftmenu a').click(function(e) {
					
		var t = jQuery(this);
		var p = t.parent();
		var ul = p.find('ul');
		var li = jQuery(this).parents('.lefticon');
		
 		//check if menu have sub menu
		if(jQuery(this).hasClass('menudrop')) {
			
			//check if menu is collapsed
			if(!li.length > 0) {
			
				//check if sub menu is available
				if(ul.length > 0) {

					ul1 = ul.attr('id') ;
			    var k = ul1.split("acc");
					var k1 = k[1] ;		


					//check if menu is visible
					if(ul.is(':visible')) {

					jQuery('ul.acc' + k1).slideUp('fast');
					 p.next().css({borderTop: '0'});
					 t.removeClass('active');
					} 
				else 
				{

					 for(i=1;i<=21;i++)
					 {				
						 if(i == k1)
						{
						jQuery('ul.acc' + i).slideDown('fast');
						p.next().css({borderTop: '1px solid #ddd'});
						t.addClass('active');
						}
						else
						{	
						jQuery('ul.acc' + i).slideUp('fast');
						 p.next().css({borderTop: '0'});
						t.removeClass('active');
						}
						
						}
										
					}
				}
	
				if(jQuery(e.target).is('em'))
					return true;
				else
					return false;
			} else {
				return true;	
			}
		
		//redirect to assigned link when menu does not have a sub menu
		} else {
			return true;
		}
	});
	
	//show tooltip menu when left menu is collapsed
	jQuery('.leftmenu a').hover(function(){
		if(jQuery(this).parents('.lefticon').length > 0) {
			jQuery(this).next().stop(true,true).fadeIn();
		}
	},function(){
		if(jQuery(this).parents('.lefticon').length > 0) {
			jQuery(this).next().stop(true,true).fadeOut();
		}
	});
	
	//show/hide left menu to switch into full/icon only menu
	jQuery('#togglemenuleft a').click(function(){
     // var a = jQuery(".leftmenu ul li a").attr("id");
     // alert(a); 
		var page = jQuery("input#title1").val();
		var page1 = page.split(":");
		// alert(page1[0]);

if(page1[0] != "Reports" && page1[0] != "BOM" && page1[0] != "Dispatch" && page1[0] != "Master Data" && page1[0] != "Mtl Tracker" && page1[0] != "User"
	&& page1[0] != "Employee" && page1[0] != "Work Flow" && page1[0] != "Log" && page1[0] != "Template")
{
	var elemID = jQuery(".leftmenu ul li ul").filter(function()
			{
				if(jQuery(this).css("display") === "block")
				{
           
				 dispblock = this.id;
				//alert(dispblock);
	      		}
	     						                               
			});
		
	
	    jQuery('.leftmenu ul li ul#' +dispblock).css("display","block");

		}
	
        jQuery('.leftmenu ul li a').css("background-color","#d5d5d5");        

		if(jQuery('.mainwrapper').hasClass('lefticon')) {
                   
			jQuery('.mainwrapper').removeClass('lefticon');
			jQuery(this).removeClass('toggle');
			
			//remove all tooltip element upon switching to full menu view
			jQuery('.leftmenu a').each(function(){
   /*                 var accid = jQuery(".leftmenu").find("li").attr('id'); 
		alert(accid);*/
		    jQuery('.leftmenu ul li a').css("background-color","#FFFFFF");        

			 jQuery(this).next().remove();
			});
			
		} else {
			jQuery('.mainwrapper').addClass('lefticon');
			jQuery(this).addClass('toggle');
           
        /*   var displayID = jQuery(".leftmenu ul li ul").filter(function()
			{
				
				if(jQuery(this).css("display") === "block")
				{
				 block = this.id;
				alert(block);
			
				}
				                               
			});
           	alert(block);
           jQuery('.leftmenu ul li ul#'  + block).css("background-color","#FFFFFF");*/
			if(page1[0] =='CRM')
				{
                   // alert(2);
			       jQuery('.leftmenu ul li a#href1.sales').css("background-image","/images/icons/default/sales.png");
			       jQuery('.leftmenu ul li a#href1.sales').css("background-color","#FFFFFF");
				  
				}
			if(page1[0] =='MES')
				{
					// alert(5);
				jQuery('.leftmenu ul li a#href2.ppc').css("background-image","/images/icons/default/ppc.png");;
				jQuery('.leftmenu ul li a#href2.ppc').css("background-color","#FFFFFF");
				}
			if(page1[0] =='Purchasing')
				{
				jQuery('.leftmenu ul li a#href3.purc').css("background-image","/images/icons/default/purchasing.png");
				jQuery('.leftmenu ul li a#href3.purc').css("background-color","#FFFFFF");
				}
			if(page1[0] =='WO')
				{
				jQuery('.leftmenu ul li a#href4.work').css("background-image","/images/icons/default/work_orders.png");
				jQuery('.leftmenu ul li a#href4.work').css("background-color","#FFFFFF");
				}
			if(page1[0] =='Post Process')
				{
				jQuery('.leftmenu ul li a#href5.post_process').css("background-image","/images/icons/default/ppc.jpg");
				jQuery('.leftmenu ul li a#href5.post_process').css("background-color","#FFFFFF");
				}
			if(page1[0] =='BOM')
				{
				jQuery('.leftmenu ul li a#href6.bom').css("background-image","/images/icons/default/bom.png");
				jQuery('.leftmenu ul li a#href6.bom').css("background-color","#FFFFFF");
				}
			if(page1[0] =='Stores')
				{
				jQuery('.leftmenu ul li a#href7.stores').css("background-image","/images/icons/default/stores2.png");
				jQuery('.leftmenu ul li a#href7.stores').css("background-color","#FFFFFF");
				}
			if(page1[0] =='QA')
				{
				jQuery('.leftmenu ul li a#href8.qa').css("background-image","/images/icons/default/qa.png");
				jQuery('.leftmenu ul li a#href8.qa').css("background-color","#FFFFFF");
				}
			if(page1[0] =='Dispatch')
				{
				jQuery('.leftmenu ul li a#href9.dispatch').css("background-image","/images/icons/default/dispatch.jpg");
				jQuery('.leftmenu ul li a#href9.dispatch').css("background-color","#FFFFFF");
				}
			if(page1[0] =='Accounts' || page1[0] =='Accounts')
				{
				jQuery('.leftmenu ul li a#href10.account').css("background-image","/images/icons/default/account.png");
				jQuery('.leftmenu ul li a#href10.account').css("background-color","#FFFFFF");
				}
				if(page1[0] =='Mtl Tracker')
				{
				jQuery('.leftmenu ul li a#href11.mtl_tracker').css("background-image","/images/icons/default/mtl_tracker2.png");
				jQuery('.leftmenu ul li a#href11.mtl_tracker').css("background-color","#FFFFFF");
				}
				if(page1[0] =='Master Data')
				{
				jQuery('.leftmenu ul li a#href12.master_data').css("background-image","/images/icons/default/master_data.png");
			    jQuery('.leftmenu ul li a#href12.master_data').css("background-color","#FFFFFF");
				}
				if(page1[0] =='PRODN')
				{
				jQuery('.leftmenu ul li a#href13.prodn').css("background-image","/images/icons/default/post_process.png");
				jQuery('.leftmenu ul li a#href13.prodn').css("background-color","#FFFFFF");
				}
				if(page1[0] =='Invoice')
				{
				jQuery('.leftmenu ul li a#href14.invoice').css("background-image","/images/icons/default/invoice.jpg");
				jQuery('.leftmenu ul li a#href14.invoice').css("background-color","#FFFFFF");
				}
				if(page1[0] =='Reports')
				{
				jQuery('.leftmenu ul li a#href15.reports').css("background-image","/images/icons/default/report.png");
				jQuery('.leftmenu ul li a#href15.reports').css("background-color","#FFFFFF");
				}
				if(page1[0] =='user')
				{
				jQuery('.leftmenu ul li a#href12.user').css("background-image","/images/icons/default/report.png");
				jQuery('.leftmenu ul li a#href12.user').css("background-color","#FFFFFF");
				}
				if(page1[0] =='Employee')
				{
				jQuery('.leftmenu ul li a#href11.employees').css("background-image","/images/icons/default/report.png");
				jQuery('.leftmenu ul li a#href11.employees').css("background-color","#FFFFFF");
				}
				if(page1[0] =='Work Flow')
				{
				jQuery('.leftmenu ul li a#href13.workflow').css("background-image","/images/icons/default/report.png");
				jQuery('.leftmenu ul li a#href13.workflow').css("background-color","#FFFFFF");
				}
				if(page1[0] =='Log')
				{
				jQuery('.leftmenu ul li a#href14.log').css("background-image","/images/icons/default/report.png");
				jQuery('.leftmenu ul li a#href14.log').css("background-color","#FFFFFF");
				}
				if(page1[0] =='Template')
				{
				jQuery('.leftmenu ul li a#href15.template').css("background-image","/images/icons/default/report.png");
				jQuery('.leftmenu ul li a#href15.template').css("background-color","#FFFFFF");
				}
				if(page1[0] =='TimeSheet')
				{
				jQuery('.leftmenu ul li a#href24.timesheet').css("background-image","/images/icons/default/report.png");
				jQuery('.leftmenu ul li a#href24.timesheet').css("background-color","#FFFFFF");
				}
				if(page1[0] =='EmployeeConfig')
				{
				jQuery('.leftmenu ul li a#href23.timesheet').css("background-image","/images/icons/default/report.png");
				jQuery('.leftmenu ul li a#href23.timesheet').css("background-color","#FFFFFF");
				}
				if(page1[0] =='Contract')
				{
				jQuery('.leftmenu ul li a#href25.contract').css("background-image","/images/icons/default/report.png");
				jQuery('.leftmenu ul li a#href25.contract').css("background-color","#FFFFFF");
				}
				if(page1[0] =='ResourceSchdule')
				{
				jQuery('.leftmenu ul li a#href26.resource').css("background-image","/images/icons/default/report.png");
				jQuery('.leftmenu ul li a#href26.resource').css("background-color","#FFFFFF");
				}
		// jQuery(".widgets").css("background-color","white");
			showTooltipLeftMenu();
		}
	});
	
	function showTooltipLeftMenu() {
		//create tooltip menu upon switching to icon only menu view
		    jQuery('.leftmenu a').each(function(){
	    	var text = jQuery(this).text();								//get the text
			jQuery(this).removeClass('active');							//reset when there is/are active menu upon switching to icon view
			jQuery(this).parent().attr('style','');						//clear style attribute to this menu
			jQuery(this).parent().find('ul').hide();					//hide sub menu when there is/are showed sub menu
			jQuery(this).after('<div class="menutip">'+text+'</div>');	//append menu tooltip
		});	
	}
	

	/** FLOAT LEFT SIDEBAR **/
	jQuery(document).scroll(function(){
		var pos = jQuery(document).scrollTop();
		if(pos > 50) {
			jQuery('.floatleft').css({position: 'fixed', top: '10px', right: '10px'});
		} else {
			jQuery('.floatleft').css({position: 'absolute', top: 0, right: 0});
		}
	});
	
	/** FLOAT RIGHT SIDEBAR **/
	jQuery(document).scroll(function(){
		if(jQuery(this).width() > 580) {
			var pos = jQuery(document).scrollTop();
			if(pos > 50) {
				jQuery('.floatright').css({position: 'fixed', top: '10px', right: '10px'});
			} else {
				jQuery('.floatright').css({position: 'absolute', top: 0, right: 0});
			}
		}
	});
	
	
	//NOTIFICATION CLOSE BUTTON
	jQuery('.notification .close').click(function(){
		jQuery(this).parent().fadeOut();
	});
	
	
	//button hover
	jQuery('.btn').hover(function(){
		jQuery(this).stop().animate({backgroundColor: '#eee'});
	},function(){
		jQuery(this).stop().animate({backgroundColor: '#f7f7f7'});
	});
	
	//standard button hover
	jQuery('.stdbtn').hover(function(){
		jQuery(this).stop().animate({opacity: 0.75});
	},function(){
		jQuery(this).stop().animate({opacity: 1});
	});
	
	//buttons in error page
	jQuery('.errorWrapper a').hover(function(){
		jQuery(this).switchClass('default','hover');
	},function(){
		jQuery(this).switchClass('hover', 'default');
	});
	
	
	//screen resize
	var TO = false;
	jQuery(window).resize(function(){
		if(jQuery(this).width() < 1024) {
			jQuery('.mainwrapper').addClass('lefticon');
			jQuery('#togglemenuleft').hide();
			jQuery('.mainright').insertBefore('.footer');
			
			showTooltipLeftMenu();
			
			if(jQuery(this).width() <= 580) {
				jQuery('.stdtable').wrap('<div class="tablewrapper"></div>');
				
				if(jQuery('.headerinner2').length == 0)
					insertHeaderInner2();
			} else {
				removeHeaderInner2();
			}
			
		} else {
			toggleLeftMenu();
			removeHeaderInner2();
		}
		
	});	
		
	if(jQuery(window).width() < 1024) {
		jQuery('.mainwrapper').addClass('lefticon');
		jQuery('#togglemenuleft').hide();
		jQuery('.mainright').insertBefore('.footer');
		
		showTooltipLeftMenu();
		
		if(jQuery(window).width() <= 580) {
			jQuery('table').wrap('<div class="tablewrapper"></div>');
			insertHeaderInner2();
		}
			
	} else {
		toggleLeftMenu();
	}
	
	function toggleLeftMenu() {

		// var page = jQuery("input#page").val();
		// alert(page);
		if(!jQuery('.mainwrapper').hasClass('lefticon')) {
			jQuery('.mainwrapper').removeClass('lefticon');
			jQuery('#togglemenuleft').show();
		} else {
			jQuery('#togglemenuleft').show();
			jQuery('#togglemenuleft a').addClass('toggle');
		}	
	}
	
	function insertHeaderInner2() {
		jQuery('.headerinner').after('<div class="headerinner2"></div>');
		jQuery('#searchPanel').appendTo('.headerinner2');
		jQuery('#userPanel').appendTo('.headerinner2');
		jQuery('#userPanel').addClass('userinfomenu');
	}
	
	function removeHeaderInner2() {
		jQuery('#searchPanel').insertBefore('#notiPanel');
		jQuery('#userPanel').insertAfter('#notiPanel');
		jQuery('#userPanel').removeClass('userinfomenu');
		jQuery('.headerinner2').remove();
	}
	
	
	jQuery('body').append('<div class="theme"><h4>Color</h4><a href="darkblue/dashboard.html" class="darkblue"></a><a href="gray/dashboard.html" class="gray"></a></div>');
	
});


jQuery(document).ready(function () {
var page = jQuery('input#title1').val();
// alert(page);	
if(page == 'CRM: Leads')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc1').css('display' , 'block');

//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul2 a span').css('background' , '#EEEEEE');
// jQuery('.leftmenu ul li#ul1 a span').append('&nbsp&nbsp<img src="./images/childarrow1.png" width="15%" height="15%">');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');


}

else if(page == 'CRM: Opportunity')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul3 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}

else if(page == 'CRM: Quote')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul4 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}
else if(page == 'CRM: Enquiry')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul5 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}
else if(page == 'CRM: Cust Feedback')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ulc_1 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}

/*else if(page == 'CRM: Cust PO')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul5 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}/*
else if(page == 'CRM: Assy Review')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul6 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}*/

else if(page == 'CRM: Assy Review')
{

jQuery('.leftmenu ul#acc1').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul_a10 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}

else if(page == 'CRM: Post Contract Review')
{

jQuery('.leftmenu ul#acc1').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ulp_11 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}

else if(page == 'CRM: Sales Order')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul6 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}

else if(page == 'CRM: Competitor')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul7 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}

else if(page == 'CRM: Summary')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul1 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}

else if(page == 'CRM: Time Master')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul8 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}

else if(page == 'CRM: Project')
{
	jQuery('.leftmenu ul#acc1').css('display' , 'block');
	jQuery('.leftmenu ul li#ul34 a span').css('background' , '#EEEEEE');
	jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
}


if(page == 'MES: delivery Sch')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc2').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul9 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href2 span').css('background' , '#bababa');
}else if(page == 'MES: Cap Master')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc2').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul10 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href2 span').css('background' , '#bababa');
}

else if(page == 'MES: Time Master')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc2').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul8 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href2 span').css('background' , '#bababa');
}
else if(page == 'MES: Production Sch')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc2').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul11 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href2 span').css('background' , '#bababa');
}
else if(page == 'MES: Cap Plan')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc2').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul12 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href2 span').css('background' , '#bababa');
}
else if(page == 'MES: Cap Chart')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc2').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul13 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href2 span').css('background' , '#bababa');
}
else if(page == 'MES: NC')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc2').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul22 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href2 span').css('background' , '#bababa');
}
else if(page == 'MES: RCCP')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc2').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul_rc a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href2 span').css('background' , '#bababa');
}
else if(page == 'MES: CRP')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc2').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul_cr a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href2 span').css('background' , '#bababa');
}

/*else if(page == 'PPC: Operator')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc2').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul13 a span').css('background' , '#EEEEEE');
}
*/

if(page == 'Purchasing: PO')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc3').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul14 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href3 span').css('background' , '#bababa');
}
else if(page == 'Purchasing: NC')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc3').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul22 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href3 span').css('background' , '#bababa');
}
else if(page == 'Purchasing: Dispatch')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc3').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul20 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href3 span').css('background' , '#bababa');
}
else if(page == 'Purchasing: CUST PO')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc3').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ula3 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href3 span').css('background' , '#bababa');
}
else if(page == 'Purchasing: RM Master')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc3').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul15 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href3 span').css('background' , '#bababa');
}
else if(page == 'Purchasing: Part Master')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc3').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul16 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href3 span').css('background' , '#bababa');
}
else if(page == 'Purchasing: Mtl Tracker')
{

	jQuery('.leftmenu ul#acc3').css('display' , 'block');
	jQuery('.leftmenu ul li#ulmt17 a span').css('background' , '#EEEEEE');
	jQuery('.leftmenu ul li a#href3 span').css('background' , '#bababa');
}
else if(page == 'Purchasing: Supplier Enquiry')
{

	jQuery('.leftmenu ul#acc3').css('display' , 'block');
	jQuery('.leftmenu ul li#ul35 a span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#href3 span').css('background' , '#bababa');
}
else if(page == 'Purchasing: Supplier Quote')
{

	jQuery('.leftmenu ul#acc3').css('display' , 'block');
	jQuery('.leftmenu ul li#ul36 a span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#href3 span').css('background' , '#bababa');
}


if(page == 'WO: Reg WO')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc4').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul17 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href4 span').css('background' , '#bababa');
}
else if(page == 'WO: Assy WO')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc4').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul18 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href4 span').css('background' , '#bababa');
}
// if(page == 'Post Process: D Note')
// {
// // alert(5);
// //jQuery('#cssmenu li#acc1').addClass('active');
// jQuery('.leftmenu ul#acc5').css('display' , 'block');
// //jQuery('#cssmenu ul#acc1').slideDown('normal');
// jQuery('.leftmenu ul li#ul19 a span').css('background' , '#EEEEEE');
// jQuery('.leftmenu ul li a#href5 span').css('background' , '#bababa');
// }

if(page == 'Post Process: D Note')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc4').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ulw19 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href4 span').css('background' , '#bababa');
}


if(page == 'BOM')
{
jQuery('.leftmenu ul li a#href6 span').css('background' , '#bababa');
}
if(page == 'Stores: GRN')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc7').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul20 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href7 span').css('background' , '#bababa');
}
else if(page == 'Stores: NC')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc7').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul21 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href7 span').css('background' , '#bababa');
}
else if(page == 'Stores: CUST PO')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc7').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ula3 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href7 span').css('background' , '#bababa');
}
else if(page == 'Stores: SP PO')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc7').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ulc2 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href7 span').css('background' , '#bababa');
}
else if(page == 'Stores: Boxing')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc7').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul_st1 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href7 span').css('background' , '#bababa');
}
if(page == 'QA: NC')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc8').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul22 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href8 span').css('background' , '#bababa');
}
else if(page == 'QA: Stores NC' )
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc8').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul21 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href8 span').css('background' , '#bababa');
}
else if(page == 'QA: PO')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc8').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul14 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href8 span').css('background' , '#bababa');
}
else if(page == 'QA: D Note')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc8').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul19 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href8 span').css('background' , '#bababa');
}
else if(page == 'QA: Dispatch')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc8').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul20 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href8 span').css('background' , '#bababa');
}
else if(page == 'QA: CUST PO')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc8').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ula3 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href8 span').css('background' , '#bababa');
}
else if(page == 'QA: SP PO')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc8').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ulc2 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href8 span').css('background' , '#bababa');
}

else if(page == 'QA: Assy Review')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc8').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul6 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href8 span').css('background' , '#bababa');
}
else if(page == 'QA: Final Insp')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc8').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul23 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href8 span').css('background' , '#bababa');
}
else if(page == 'QA: Fair')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc8').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul24 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href8 span').css('background' , '#bababa');
}
else if(page == 'View: PO')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc_ppc15').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul14 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href_ppc15 span').css('background' , '#bababa');
}
else if(page == 'View: Master Data')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc_ppc15').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ull1 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href_ppc15 span').css('background' , '#bababa');
}

else if(page == 'View: CUST PO')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc_ppc15').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ula3 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href_ppc15 span').css('background' , '#bababa');
}

else if(page == 'View: SP PO')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc_ppc15').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ulc2 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href_ppc15 span').css('background' , '#bababa');
}
else if(page == 'View: Assy Review')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc_ppc15').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul6 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href_ppc15 span').css('background' , '#bababa');
}
else if(page == 'View: Fair')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc_ppc15').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul24 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href_ppc15 span').css('background' , '#bababa');
}
else if(page == 'View: GRN')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc_ppc15').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul20 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href_ppc15 span').css('background' , '#bababa');
}
if(page == 'Dispatch')
{
jQuery('.leftmenu ul li a#href9 span').css('background' , '#bababa');
}
if(page == 'Prnoutlook')
{
jQuery('.leftmenu ul li a#href_ppc1 span').css('background' , '#bababa');
}
if(page == 'Accounts: Contacts' || page == 'Company: Contacts')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc10').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul25 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href10 span').css('background' , '#bababa');
}

if(page == 'Accounts' || page == 'Company')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc10').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul25 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href10 span').css('background' , '#bababa');
}
// if(page == 'Mtl Tracker')
// {

// jQuery('.leftmenu ul li a#href11 span').css('background' , '#bababa');
// }
if(page == 'Master Data')
{

jQuery('.leftmenu ul li a#href12 span').css('background' , '#bababa');
}

if(page == 'PRODN: Operator')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc13').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul26 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href13 span').css('background' , '#bababa');
}
else if(page == 'PRODN: CUST PO')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc13').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ula3 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href13 span').css('background' , '#bababa');
}
else if(page == 'PRODN: NC')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc13').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul22 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href13 span').css('background' , '#bababa');
}
// alert(page);
if(page == 'Invoice: Invoice')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc14').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul27 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href14 span').css('background' , '#bababa');
}
if(page == 'Invoice: Cust Invoice')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc14').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul28 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href14 span').css('background' , '#bababa');
}
if(page == 'Invoice: Packing')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc14').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul29 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href14 span').css('background' , '#bababa');
}
if(page == 'Invoice: Price')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc14').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul30 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href14 span').css('background' , '#bababa');
}
if(page == 'Invoice: Excise')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc14').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul31 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href14 span').css('background' , '#bababa');
}
if(page == 'Invoice: Appendixc')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc14').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul32 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href14 span').css('background' , '#bababa');
}
if(page == 'Invoice: Arform')
{
// alert(page);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc14').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ul33 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href14 span').css('background' , '#bababa');
}
if(page == 'Reports')
{
jQuery('.leftmenu ul#acc15').css('display' , 'block');
jQuery('.leftmenu ul li a#href15 span').css('background' , '#bababa');
}
if(page == 'Employee')
{
jQuery('.leftmenu ul#acc11').css('display' , 'block');
jQuery('.leftmenu ul li a#href11 span').css('background' , '#bababa');
}
if(page == 'User')
{
jQuery('.leftmenu ul#acc12').css('display' , 'block');
jQuery('.leftmenu ul li a#href12 span').css('background' , '#bababa');
}
if(page == 'Work Flow')
{
jQuery('.leftmenu ul#acc13').css('display' , 'block');
jQuery('.leftmenu ul li a#href13 span').css('background' , '#bababa');
}
if(page == 'Log')
{
jQuery('.leftmenu ul#acc14').css('display' , 'block');
jQuery('.leftmenu ul li a#href14 span').css('background' , '#bababa');
}
if(page == 'Template')
{
jQuery('.leftmenu ul#acc15').css('display' , 'block');
jQuery('.leftmenu ul li a#href15 span').css('background' , '#bababa');
}
if(page == 'TimeSheet')
{
jQuery('.leftmenu ul#acc24').css('display' , 'block');
jQuery('.leftmenu ul li a#href24 span').css('background' , '#bababa');
}
if(page == 'EmployeeConfig')
{
jQuery('.leftmenu ul#acc23').css('display' , 'block');
jQuery('.leftmenu ul li a#href23 span').css('background' , '#bababa');
}
if(page == 'Contract')
{
jQuery('.leftmenu ul#acc25').css('display' , 'block');
jQuery('.leftmenu ul li a#href25 span').css('background' , '#bababa');
}
if(page == 'ResourceSchdule')
{
jQuery('.leftmenu ul#acc26').css('display' , 'block');
jQuery('.leftmenu ul li a#href26 span').css('background' , '#bababa');
}

// if(page == 'Payroll: Master')
// {
// 	jQuery('.leftmenu ul#acc_pay').css('display' , 'block');
// 	jQuery('.leftmenu ul li#ulp1 a span').css('background' , '#EEEEEE');
// 	jQuery('.leftmenu ul li a#href_pay span').css('background' , '#bababa');
// 	}
// if(page == 'Payroll: Monthly')
// {
// 	jQuery('.leftmenu ul#acc_pay').css('display' , 'block');
// 	jQuery('.leftmenu ul li#ulp2 a span').css('background' , '#EEEEEE');
// 	jQuery('.leftmenu ul li a#href_pay span').css('background' , '#bababa');
// }

if(page == 'ELM: Master')
{
	jQuery('.leftmenu ul#acc21').css('display' , 'block');
	jQuery('.leftmenu ul#acc16').css('display' , 'block');
	jQuery('.leftmenu ul li#ulp1 a span').css('background' , '#EEEEEE');
	jQuery('.leftmenu ul li a#href21 span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#href16 span').css('background' , '#bababa');
}

if(page == 'ELM: Monthly')
{
	jQuery('.leftmenu ul#acc21').css('display' , 'block');
	jQuery('.leftmenu ul#acc16').css('display' , 'block');
	jQuery('.leftmenu ul li#ulp2 a span').css('background' , '#EEEEEE');
	jQuery('.leftmenu ul li a#href21 span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#href16 span').css('background' , '#bababa');
}


if(page == 'ELM: Project')
{
	jQuery('.leftmenu ul#acc21').css('display' , 'block');
	jQuery('.leftmenu ul#acc22').css('display' , 'block');
	jQuery('.leftmenu ul li#ultm1 a span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#href22 span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#href21 span').css('background' , '#bababa');
}

if(page == 'ELM: Attendance')
{
	jQuery('.leftmenu ul#acc21').css('display' , 'block');
	jQuery('.leftmenu ul#acc22').css('display' , 'block');
	jQuery('.leftmenu ul li#ulam2 a span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#href22 span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#href21 span').css('background' , '#bababa');
}
if(page == 'ELM: Leave')
{
	
	jQuery('.leftmenu ul#acc21').css('display' , 'block');
	jQuery('.leftmenu ul#acc22').css('display' , 'block');
	jQuery('.leftmenu ul li#ulam3 a span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#href22 span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#href21 span').css('background' , '#bababa');
}

if(page == 'ELM: ResourcePlanning')
{
	jQuery('.leftmenu ul#acc21').css('display' , 'block');
	jQuery('.leftmenu ul li#ulelm7 a span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#ulelm7 span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#href21 span').css('background' , '#bababa');
}


 if(page == 'Support: New SR')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
jQuery('.leftmenu ul#acc17').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ulp1 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
jQuery('.leftmenu ul li a#href17 span').css('background' , '#bababa');
}
if(page == 'Support')
{
jQuery('.leftmenu ul li a#href10 span').css('background' , '#bababa');
}
 else if(page == 'Support: New RMA')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc17').css('display' , 'block');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ulsu2 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href17 span').css('background' , '#bababa');
}
 else if(page == 'Support: New ECO')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc17').css('display' , 'block');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ulsu3 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href17 span').css('background' , '#bababa');
}

  if(page == 'Solution: Solution')
{
	jQuery('.leftmenu ul#acc16').css('display' , 'block');
	jQuery('.leftmenu ul#acc1').css('display' , 'block');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
	jQuery('.leftmenu ul li a#href16 span').css('background' , '#bababa');
}

else if(page == 'Solution: New Solution')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc16').css('display' , 'block');
jQuery('.leftmenu ul#acc1').css('display' , 'block');
jQuery('.leftmenu ul li a#href1 span').css('background' , '#bababa');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#uls1 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href16 span').css('background' , '#bababa');
}
// alert(page);
if(page == 'Utillities: Email')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc18').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ulu1 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href18 span').css('background' , '#bababa');
}


else if(page == 'Utillities: Calendar')
{
// alert(5);
//jQuery('#cssmenu li#acc1').addClass('active');
jQuery('.leftmenu ul#acc18').css('display' , 'block');
//jQuery('#cssmenu ul#acc1').slideDown('normal');
jQuery('.leftmenu ul li#ulu2 a span').css('background' , '#EEEEEE');
jQuery('.leftmenu ul li a#href18 span').css('background' , '#bababa');
}


if(page == 'ELM: Summary')
{
	jQuery('.leftmenu ul#acc21').css('display' , 'block');
	jQuery('.leftmenu ul li#ulelm1 a span').css('background' , '#EEEEEE');
	jQuery('.leftmenu ul li a#href21 span').css('background' , '#bababa');
}

// if(page == 'Project')
// {

// jQuery('.leftmenu ul#acc19').css('display' , 'block');
// jQuery('.leftmenu ul li a#href19 span').css('background' , '#bababa');
// }


});

// jQuery(document).ready(function(){
//     jQuery("#togglemenuleft a").click(function(){
//     jQuery(".leftmenu ul li").each(function(){
//           alert(jQuery(this).attr('id'));
//         });
//     });
// });