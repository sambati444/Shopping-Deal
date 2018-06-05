	<script>
	function selectState(myvalue)
	{
		var xmlhttp;
		document.getElementById('loaderAjax').style.display="block";
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}	
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("state").innerHTML = xmlhttp.responseText;
				document.getElementById('loaderAjax').style.display="none";
			}
		}
		xmlhttp.open("GET","web_require/web_ajax/ajax_state.php?country="+myvalue, true);
		xmlhttp.send();
	}
	function selectCity(myvalue)
	{
		var xmlhttp;
		document.getElementById('loaderAjax').style.display="block";
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}	
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById("city").innerHTML = xmlhttp.responseText;
				document.getElementById('loaderAjax').style.display="none";
			}
		}
		xmlhttp.open("GET","web_require/web_ajax/ajax_district.php?state="+myvalue, true);
		xmlhttp.send();
	}
	function formSubmission()
	{
		var fname=document.getElementById('fname').value;
		var lname=document.getElementById('lname').value;
		var mobileno=document.getElementById('mobileno').value;
		var emailid=document.getElementById('emailid').value;
		var landlineno=document.getElementById('landlineno').value;
		var faxno=document.getElementById('faxno').value;
		var address=document.getElementById('address').value;
		var country=document.getElementById('country').value;
		var state=document.getElementById('state').value;
		var city=document.getElementById('city').value;
		var pincode=document.getElementById('pincode').value;
		var number=/^[0-9]+$/;
		var character=/^[A-Z a-z]+$/;
		var atpos=emailid.indexOf("@");
		var dotpos=emailid.lastIndexOf(".");
		/*==FIRST NAME==*/
		if(fname=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("fnameError").style.display="block";
			document.getElementById("fnameError").innerHTML="Enter First Name";
			return false
		}
		else
		{
			if(fname.match(number))
			{
				document.getElementById("msgOnError").style.display="block";
				document.getElementById("fnameError").style.display="block";
				document.getElementById("fnameError").innerHTML="Numbers not allowed";
				return false
			}
			else
			{
				document.getElementById("fnameError").innerHTML=1;
				document.getElementById("fnameError").style.display="none";
			}
		}
		/*==LAST NAME==*/
		if(lname=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("lnameError").style.display="block";
			document.getElementById("lnameError").innerHTML="Enter Last Name";
			return false;
		}
		else
		{
			if(lname.match(number))
			{
				document.getElementById("msgOnError").style.display="block";
				document.getElementById("lnameError").style.display="block";
				document.getElementById("lnameError").innerHTML="Numbers not allowed";
				return false;
			}
			else
			{
				document.getElementById("lnameError").innerHTML=1;
				document.getElementById("lnameError").style.display="none";
			}
		}
		/*==MOBILE NO==*/
		if(mobileno=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("mobilenoError").style.display="block";
			document.getElementById("mobilenoError").innerHTML="Enter Mobile No.";
		}
		else
		{
			if(mobileno.match(character)||mobileno.length>10||mobileno.length<10)
			{
				document.getElementById("msgOnError").style.display="block";
				document.getElementById("mobilenoError").style.display="block";
				document.getElementById("mobilenoError").innerHTML="Characters not allowed";
			}
			else
			{
				document.getElementById("mobilenoError").innerHTML=1;
				document.getElementById("mobilenoError").style.display="none";
			}
		}
		/*==E-MAIL ID==*/
		if(emailid=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("emailidError").style.display="block";
			document.getElementById("emailidError").innerHTML="Enter Valid E-mail ID";
		}
		else
		{
			if(atpos<1||dotpos<atpos+2||dotpos+2>=emailid.length)
			{
				document.getElementById("msgOnError").style.display="block";
				document.getElementById("emailidError").style.display="block";
				document.getElementById("emailidError").innerHTML="Invalid E-mail ID";
			}
			else
			{
				document.getElementById("emailidError").innerHTML=1;
				document.getElementById("emailidError").style.display="none";
			}
		}
		/*==LANDLINE NO==*/
		if(landlineno.match(character))
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("landlinenoError").style.display="block";
			document.getElementById("landlinenoError").innerHTML="Characters not allowed";
		}
		else
		{
			document.getElementById("landlinenoError").style.display="none";
		}
		/*==FAX NO==*/
		if(faxno.match(character))
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("faxnoError").style.display="block";
			document.getElementById("faxnoError").innerHTML="Cbaracters not allowed";
		}
		else
		{
			document.getElementById("faxnoError").innerHTML=1;
			document.getElementById("faxnoError").style.display="none";
		}
		/*==ADDRESS==*/
		if(address=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("addressError").style.display="block";
			document.getElementById("addressError").innerHTML="Enter Address";
		}
		else
		{
			document.getElementById("addressError").innerHTML=1;
			document.getElementById("addressError").style.display="none";
		}
		/*==COUNTRY==*/
		if(country=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("countryError").style.display="block";
			document.getElementById("countryError").innerHTML="Select Country";
		}
		else
		{
			document.getElementById("countryError").innerHTML=1;
			document.getElementById("countryError").style.display="none";
		}
		/*==STATE==*/
		if(state=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("stateError").style.display="block";
			document.getElementById("stateError").innerHTML="Select City";
		}
		else
		{
			document.getElementById("stateError").innerHTML=1;
			document.getElementById("stateError").style.display="none";
		}
		/*==CITY==*/
		if(city=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("cityError").style.display="block";
			document.getElementById("cityError").innerHTML="Select City";
		}
		else
		{
			document.getElementById("cityError").innerHTML=1;
			document.getElementById("cityError").style.display="none";
		}
		/*==PINCODE==*/
		if(pincode=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("pincodeError").style.display="block";
			document.getElementById("pincodeError").innerHTML="Enter Pincode";
		}
		else
		{
			if(pincode.match(character))
			{
				document.getElementById("msgOnError").style.display="block";
				document.getElementById("pincodeError").style.display="block";
				document.getElementById("pincodeError").innerHTML="Characters not allowed";
			}
			else
			{
				document.getElementById("pincodeError").innerHTML=1;
				document.getElementById("pincodeError").style.display="none";
			}
		}

		/*FORM SUBMISSION VIA AJAX*/
		var trigger1=document.getElementById('fnameError').innerHTML;
		var trigger2=document.getElementById('lnameError').innerHTML;
		var trigger3=document.getElementById('mobilenoError').innerHTML;
		var trigger4=document.getElementById('emailidError').innerHTML;
		var trigger5=document.getElementById('landlinenoError').innerHTML;
		var trigger6=document.getElementById('faxnoError').innerHTML;
		var trigger7=document.getElementById('addressError').innerHTML;
		var trigger8=document.getElementById('countryError').innerHTML;
		var trigger9=document.getElementById('stateError').innerHTML;
		var trigger10=document.getElementById('cityError').innerHTML;
		var trigger11=document.getElementById('pincodeError').innerHTML;
		if(trigger1=='1'&&trigger2=='1'&&trigger3=='1'&&trigger4=='1'&&trigger5=='1'&&trigger6=='1'&&trigger7=='1'&&trigger8=='1'&&trigger9=='1'&&trigger10=='1'&&trigger11=='1')
		{
			var xmlhttp;
			document.getElementById('loaderAjax').style.display="block";
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}	
			xmlhttp.onreadystatechange = function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					if(xmlhttp.responseText!='1')
					{
						document.getElementById("msgOnError").style.display="block";
						document.getElementById("msgOnError").innerHTML = xmlhttp.responseText;
						document.getElementById('loaderAjax').style.display="none";
					}
					else
					{
						window.location="myprofile.php";
					}
				}
			}
			xmlhttp.open("GET","web_require/web_ajax/myprofile_formSubmission.php?fname="+fname+"&lname="+lname+"&mobileno="+mobileno+"&emailid="+emailid+"&landlineno="+landlineno+"&faxno="+faxno+"&address="+address+"&country="+country+"&state="+state+"&city="+city+"&pincode="+pincode, true);
			xmlhttp.send();
		}
		else
		{
			alert("error");
		}
		/*END OF AJAX CODE*/
	}
	/****FIRST NAME****/
	function fname(myvalue)
	{
		var number=/^[0-9]+$/;
		var character=/^[A-Z a-z]+$/;
		if(myvalue=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("fnameError").style.display="block";
			document.getElementById("fnameError").innerHTML="Enter First Name";
		}
		else
		{
			if(myvalue.match(number))
			{
				document.getElementById("msgOnError").style.display="block";
				document.getElementById("fnameError").style.display="block";
				document.getElementById("fnameError").innerHTML="Numbers not allowed";
				return false
			}
			else
			{
				document.getElementById("fnameError").innerHTML=1;
				document.getElementById("msgOnError").style.display="none";
				document.getElementById("fnameError").style.display="none";
			}
		}
	}
	/****LAST NAME****/
	function lname(myvalue)
	{
		var number=/^[0-9]+$/;
		var character=/^[A-Z a-z]+$/;
		if(myvalue=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("lnameError").style.display="block";
			document.getElementById("lnameError").innerHTML="Enter Last Name";
		}
		else
		{
			if(myvalue.match(number))
			{
				document.getElementById("msgOnError").style.display="block";
				document.getElementById("lnameError").style.display="block";
				document.getElementById("lnameError").innerHTML="Numbers not allowed";
			}
			else
			{
				document.getElementById("lnameError").innerHTML=1;
				document.getElementById("msgOnError").style.display="none";
				document.getElementById("lnameError").style.display="none";
			}
		}
	}
	/******MOBILE NO******/
	function mobileno(myvalue)
	{
		var number=/^[0-9]+$/;
		var character=/^[A-Z a-z]+$/;
		if(myvalue=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("mobilenoError").style.display="block";
			document.getElementById("mobilenoError").innerHTML="Enter Mobile No.";
		}
		else
		{
			if(myvalue.match(character)||myvalue.length!=10)
			{
				document.getElementById("msgOnError").style.display="block";
				document.getElementById("mobilenoError").style.display="block";
				document.getElementById("mobilenoError").innerHTML="Enter Valid Mobile No.";
			}
			else
			{
				document.getElementById("mobilenoError").innerHTML=1;
				document.getElementById("msgOnError").style.display="none";
				document.getElementById("mobilenoError").style.display="none";
			}
		}
	}
	/********E-MAIL ID*******/
	function emailid(myvalue)
	{
		var atpos=myvalue.indexOf("@");
		var dotpos=myvalue.lastIndexOf(".");
		if(myvalue=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("emailidError").style.display="block";
			document.getElementById("emailidError").innerHTML="Enter Valid E-mail ID";
		}
		else
		{
			if(atpos<1||dotpos<atpos+2||dotpos+2>=myvalue.length)
			{
				document.getElementById("msgOnError").style.display="block";
				document.getElementById("emailidError").style.display="block";
				document.getElementById("emailidError").innerHTML="Invalid E-mail ID";
			}
			else
			{
				document.getElementById("emailidError").innerHTML=1;
				document.getElementById("msgOnError").style.display="none";
				document.getElementById("emailidError").style.display="none";
			}
		}
	}
	/********LANDLINE NO*******/
	function landlineno(myvalue)
	{
		var number=/^[0-9]+$/;
		var character=/^[A-Z a-z]+$/;
		if(myvalue.match(character))
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("landlinenoError").style.display="block";
			document.getElementById("landlinenoError").innerHTML="Characters not allowed";
		}
		else
		{
			document.getElementById("landlinenoError").innerHTML=1;
			document.getElementById("msgOnError").style.display="none";
			document.getElementById("landlinenoError").style.display="none";
		}
	}
	/********FAX NO*******/
	function faxno(myvalue)
	{
		var number=/^[0-9]+$/;
		var character=/^[A-Z a-z]+$/;
		if(myvalue.match(character))
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("faxnoError").style.display="block";
			document.getElementById("faxnoError").innerHTML="Cbaracters not allowed";
		}
		else
		{
			document.getElementById("faxnoError").innerHTML=1;
			document.getElementById("msgOnError").style.display="none";
			document.getElementById("faxnoError").style.display="none";
		}
	}
	/********ADDRESS*******/
	function address(myvalue)
	{
		if(myvalue=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("addressError").style.display="block";
			document.getElementById("addressError").innerHTML="Enter Address";
		}
		else
		{
			document.getElementById("addressError").innerHTML=1;
			document.getElementById("msgOnError").style.display="none";
			document.getElementById("addressError").style.display="none";
		}
	}
	/********COUNTRY*******/
	function country(myvalue)
	{
		if(myvalue=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("countryError").style.display="block";
			document.getElementById("countryError").innerHTML="Select Country";
		}
		else
		{
			document.getElementById("countryError").innerHTML=1;
			document.getElementById("msgOnError").style.display="none";
			document.getElementById("countryError").style.display="none";
		}
	}
	/********STATE*******/
	function state(myvalue)
	{
		if(myvalue=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("stateError").style.display="block";
			document.getElementById("stateError").innerHTML="Select City";
		}
		else
		{
			document.getElementById("stateError").innerHTML=1;
			document.getElementById("msgOnError").style.display="none";
			document.getElementById("stateError").style.display="none";
		}
	}
	/********CITY*******/
	function city(myvalue)
	{
		if(myvalue=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("cityError").style.display="block";
			document.getElementById("cityError").innerHTML="Select City";
		}
		else
		{
			document.getElementById("cityError").innerHTML=1;
			document.getElementById("msgOnError").style.display="none";
			document.getElementById("cityError").style.display="none";
		}
	}
	/********PINCODE*******/
	function pincode(myvalue)
	{
		var number=/^[0-9]+$/;
		var character=/^[A-Z a-z]+$/;
		if(myvalue=='')
		{
			document.getElementById("msgOnError").style.display="block";
			document.getElementById("pincodeError").style.display="block";
			document.getElementById("pincodeError").innerHTML="Enter Pincode";
		}
		else
		{
			if(myvalue.match(character))
			{
				document.getElementById("msgOnError").style.display="block";
				document.getElementById("pincodeError").style.display="block";
				document.getElementById("pincodeError").innerHTML="Characters not allowed";
			}
			else
			{
				document.getElementById("pincodeError").innerHTML=1;
				document.getElementById("msgOnError").style.display="none";
				document.getElementById("pincodeError").style.display="none";
			}
		}
	}
	</script>