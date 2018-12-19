// JavaScript Document

/**/	

	var group_id = new Array();    			//holds group id numbers only

	var group_array = new Array();			//holds number of subgroups for this grup id

	var subgroup_array = new Array();		//holds information related to the group - subgroup pairing.

	var message = "";						//Holder for a message of some kind

	var len = 0;							//the number of form elements on the web (calling)page form

	var idx = 0;							//an index holder for use with array indexes

	var populated = false;					//A flag set to true when the current group passes the populated condition

	var frm_element_name;					//holds the value of the name attribute of the form element.

	var counter1=0;

	var counter2=0;

	var form_element = -1;

	var check_required = false;				//THIS IS THE RETURN CODE FOR THIS FUNCTION.  True says it has been done.

	var success = true;						//if used, will be se6t to true when a halt to something is required.

	var modifier;							//Holds the group ID number from the form

	var mod;								//holds the group ID number from the group_id Array()

	var submod;								//holds the subgroup number from the subgroup_array Array()

	var matchit = false;					//If needed, sets a true condition when two things match.  Should be reset when no loger needed

	var temp = "";

	var stng = "";

	var action_name; 

	var table_name ;

	var page_info;

	form_values = new Array();

	new_values	= new Array();

	var URL_String = "";

	pw = new Array();

	var popup="Picture protected.  Please contact us to obtain a copy";



	function MM_swapImgRestore() 

		{ //v3.0

			var i,x,a=document.MM_sr; 

			for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) 

				x.src=x.oSrc;

		}

/**/

	function MM_preloadImages() 

		{ //v3.0

			var d=document; 

			if(d.images)

				{ 

					if(!d.MM_p) 

						d.MM_p=new Array();

					var i,j=d.MM_p.length,a=MM_preloadImages.arguments; 

					for(i=0; i<a.length; i++)

					if (a[i].indexOf("#")!=0)

						{ 

							d.MM_p[j]=new Image; 

							d.MM_p[j++].src=a[i];

						}

				}

		}

	function MM_findObj(n, d) 

		{ //v4.01

			var p,i,x;  

			if(!d) 

				d=document; 

			if((p=n.indexOf("?"))>0&&parent.frames.length) 

				{

					d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);

				}

			if(!(x=d[n])&&d.all) x=d.all[n]; 

			for (i=0;!x&&i<d.forms.length;i++) 

				x=d.forms[i][n];

			for(i=0;!x&&d.layers&&i<d.layers.length;i++) 

				x=MM_findObj(n,d.layers[i].document);

			if(!x && d.getElementById) 

				x=d.getElementById(n); 

			return x;

		}

	function MM_swapImage() 

		{ //v3.0

			var i,j=0,x,a=MM_swapImage.arguments; 

			document.MM_sr=new Array; 

			for(i=0;i<(a.length-2);i+=3)

				{

					if ((x=MM_findObj(a[i]))!=null)

						{

							document.MM_sr[j++]=x; 

							if(!x.oSrc) 

								x.oSrc=x.src; x.src=a[i+2];

						}

				}

		}

	function MM_popupMsg(msg) 

		{ //v1.0						

			var qs = window.location.search;

			var qsvalue = qs.substring(qs.indexOf("=") + 1, qs.length);

			if (qsvalue == 'done')

				{

					qsvalue == '';

					alert(msg);

				}

		}

	function goback_one()

		{

			history.go(-1);

		}

	function newwin(theURL,winName,features)

		{

			winName = winName.replace(/ /g,"_");

			window.open(theURL,winName,features);

		}

	function key_capture() 

		{

			// This is here to make it easier to login to admin section (the 123 is the F12 key)

			var thisKey = event.keyCode;

			if (thisKey == 123) 

				{

					alert("hit the key");

					window.location = "";

					return;

				}

		} 

		