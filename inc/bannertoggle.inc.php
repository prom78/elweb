<SCRIPT LANGUAGE="javascript">
	function ToggleBanner() {
		if(document.getElementById('bannertext').style.visibility!='hidden') {
			document.getElementById('bannertext').style.visibility='display';
		} else {
			document.getElementById('bannertext').style.visibility='hidden';
		};//end if
	};
	function ToggleBannerHeight() {
		//alert(document.getElementById('bannerwrapper').style.height);
		if(document.getElementById('bannertext').style.height!='1pt') {
			document.getElementById('bannertext').style.height='1pt';
		} else {
			document.getElementById('bannertext').style.height='';
		};//end if
	};
</SCRIPT>
