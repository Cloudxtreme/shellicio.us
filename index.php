<?php
	include('db.php');
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Shellicio.us</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
		<script src="js/jquery.simplemodal.js"></script>
		<script src="js/jquery.corner.js"></script>
		<script src="js/main.js"></script>

		<link rel="stylesheet" href="css/modal.css" />			

		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
		<link rel="icon" type="image/png" href="images/logo.ico" />	
	</head>
	<body>
		<div id="tipTop"></div>
		<!-- Nav -->
			<nav id="nav">
				<ul class="container">
					<li><a onClick="$('#signupSection').slideUp();scrollToAnchor('tipTop');" href="/#tipTop">Top</a></li>
					<li><a href="/#signupSection" class="getCredentials">Signup</a></li>					
					<li><a onClick="$('#signupSection').slideUp();scrollToAnchor('getStarted');" href="/#getStarted">Services</a></li>
					<li><a onClick="$('#signupSection').slideUp();scrollToAnchor('contact');" href="/#contact">Contact</a></li>
					<li><a onClick="$('#signupSection').slideUp();scrollToAnchor('help');" href="/#help">Help</a></li>
					<li><a onClick="$('#signupSection').slideUp();scrollToAnchor('donate');" href="/#donate">Donate</a></li>
					<!-- Start Session Only Buttons -->
					<?php if (isset($_SESSION['session_user'])) { ?>
						<li><a href="http://shellicio.us:4200/?<?php echo $_SESSION['session_user']; ?>" class="" target="_new"><span class="icon fa-terminal"></span></a></li>
						<li><a href="https://mail.shellicio.us/?_user=<?php echo $_SESSION['session_user']; ?>" class="" target="_new"><span class="icon fa-envelope"></span></a></li>
						<li><a href="https://database.shellicio.us/?pma_username=<?php echo $_SESSION['session_user']; ?>&pma_password=<?php echo $_SESSION['session_pass']; ?>" class="" target="_new"><span class="icon fa-database"></span></a></li>
					<?php } ?>
					<!-- End Session Only Buttons -->
				</ul>
			</nav>
		<!-- Signup -->
			<div id="signupSection" class="wrapper style2" style="margin-top:0px;display:none;background-color:white;background-image:url(images/binary.jpg);background-repeat:no-repeat;background-position:center;">
				<article id="" style="">
					<header style="">
						<br /><br />
						<h1>Get Your Credentials</h1>
						<p id="signupMessage">Please enter your email address. We will send your active credentials instantly.</p>
					</header>
					<div id="signupMain" style="">
						<p><input type="text" size="30" id="userEmail" name="userEmail" style="text-align:center;"></input></p>
						<p><a id="" href="/#" class="button big scrolly" style="" onClick="var userEmail = $('#userEmail').val(); getCreds(userEmail);">I Agree</a></p>
					</div>
					<div id="signupMainTemplate" style="display:none;">
						<p><input type="text" size="30" id="userEmail" name="userEmail" style="text-align:center;"></input></p>
						<p><a id="" href="/#" class="button big scrolly" style="" onClick="var userEmail = $('#userEmail').val(); getCreds(userEmail);">I Agree</a></p>
					</div>					
					<footer id="signupFooter" style="">
						<p>By click "I Agree" you are acknowledging our <a href="/#tipTop" class="TermsOfUseButton">Terms of Use</a> and <a href="/#tipTop" class="PrivacyPolicyButton">Privacy Policy</a>. Click "I Agree" to receive your credentials.
					</footer>
				</article>
			</div>	
		<!-- Home -->
			<div class="wrapper style1 first" style="margin-top:0px !important;">
				<article class="container" id="top">
					<div class="row">
						<div class="4u">
							<span class="image fit"><img src="images/logo.png" alt="" /></span>
						</div>
						<div class="8u">
							<header>
								<?php if (!isset($_SESSION['session_user'])) { ?>
									<h1>Hi. We're <strong>Shellicio.us</strong>.</h1>
								<?php } else { ?>
									<h1>Welcome to <strong>Shellicio.us</strong>!</h1>
								<?php } ?>	
							</header>
							<?php if (!isset($_SESSION['session_user'])) { ?>
							<p>And this is our collection of <strong>free</strong> services. Secure, fast and reliable.
							<span class="icon fa-apple"></span>&nbsp;&nbsp;<span class="icon fa-windows"></span>&nbsp;&nbsp;<span class="icon fa-linux" style="margin-right:10px;"></span><span style="font-size:.5em !important;">All major operating systems supported.</span><br />
							<a href="/#getStarted" class="button big scrolly" style="font-size:.9em;">Learn More and Get Started</a></p>
							<?php } else { ?>
							<p>We have your email address on file as <b><?php echo $_SESSION['session_email'];?></b>. It will be removed along with all records in 12 hours when your session expires. Use the tool icons at the top of screen to utilize your session, or check out the <a onClick="$('#signupSection').slideUp();scrollToAnchor('help');" href="/#help">Help</a> section for assistance.</p>
							<?php } ?>
						</div>
					</div>
				</article>
			</div>
		<!-- getStarted -->
			<div class="wrapper style2">
				<article id="getStarted">
					<header>
						<br /><br /><br />
						<h2>Here's what you get.</h2>
						<p>Our services are provided for free and funded by donations.</p>
					</header>
					<div class="container">
						<div class="row">
							<div class="4u">
								<section class="box style1">
									<span class="icon featured fa-shield"></span>
									<h3>VPN Access</h3>
									<p>Encrypted and secure private VPN tunnel. Ability to access traditional and Tor networks. Credentials expire every 12 hours. L2TP currently utilized, with other options in the near future.</p>
								</section>
							</div>
							<div class="4u">
								<section class="box style1">
									<span class="icon featured fa-terminal"></span>
									<h3>SSH + FTP Shell Access</h3>
									<p>Secure shell SSH/FTP account access and storage. </p>
								</section>
							</div>							
							<div class="4u">
								<section class="box style1">
									<span class="icon featured fa-globe"></span>
									<h3>HTTP + HTTPS Server</h3>
									<p>Web server account access and storage. SSL and non SSL HTTP service included with PHP enabled. No database service at this time.</p>
								</section>
							</div>
						</div>
					</div>
					<footer>
						<p>Are you ready to get started? Everything is free and anonymous.</p>
						<a id="" href="/#signupSection" class="button big scrolly getCredentials" style="margin-right:10px;">Get Your Credentials Now!</a>
					</footer>
				</article>
			</div>					
		<!-- Help -->
			<div class="wrapper style1">
				<article id="help" class="container 75%">
					<header>
						<br /><br /><br />
						<h2>Great, now what do I do with it?</h2>
						<p>We have assembled some resources to help you utilize your new free services. Below is an assortment of tools and documentation.</p>
					</header>
				<ul>
					<li><a href="/?subject=ClientConfiguration#help">Configure Windows, OSX or Linux to use the PPTP VPN tunnel.</a></li>
					<?php if($_GET['subject'] == 'ClientConfiguration') {
						echo '<br /><div style=""><h3>Client Configuration</h3><h4>For all devices running Windows, OSX or Linux based operating systems.</h4><p>More documentation to come...</p></div>';
					}  ?>
					<li><a href="/?subject=BrowserTerminal#help">Start a browser shell terminal.</a></li>
					<?php if($_GET['subject'] == 'BrowserTerminal') {
						echo '<br /><div style=""><h3>Start a Browser Shell Terminal</h3><h4>For connecting to and using the linux shell.</h4><p>More documentation to come...</p></div>';
					}  ?>					
					<li><a href="/?subject=ConnectOverSSH#help">Connect to your shell over SSH.</a></li>
					<?php if($_GET['subject'] == 'ConnectOverSSH') {
						echo '<br /><div style=""><h3>Connect with SSH</h3><h4>For connecting to and using the linux shell over SSH.</h4><p>More documentation to come...</p></div>';
					}  ?>							
					<li><a href="/?subject=ConnectOverFTP#help">Connect to your shell over FTP.</a></li>	
					<?php if($_GET['subject'] == 'ConnectOverFTP') {
						echo '<br /><div style=""><h3>Connect with FTP</h3><h4>For connecting and using FTP.</h4><p>More documentation to come...</p></div>';
					}  ?>											
					<li><a href="/?subject=WebService#help">HTTPS/HTTP Service overview.</a></li>
					<?php if($_GET['subject'] == 'WebService') {
						echo '<br /><div style=""><h3>HTTPS/HTTP Service Overview</h3><h4>Your web address, protocols and folder information.</h4><p>More documentation to come...</p></div>';
					}  ?>							
					<li><a href="/?subject=Donate#help">Donate and set your own account expiration.</a></li>
					<?php if($_GET['subject'] == 'Donate') {
						echo '<br /><div style=""><h3>Donate to Shellicio.us</h3><h4>Even the smallest donation gets you a lifetime account.</h4><p>More documentation to come...</p></div>';
					}  ?>							
				</ul>
				Read our <a href="#help" class="TermsOfUseButton">Terms of Use</a> or <a href="#help" class="PrivacyPolicyButton">Privacy Policy</a>.					</article>	
			</div>
		<!-- Donate -->
			<div class="wrapper style2">
				<article id="donate" class="container 75%">
					<header>
						<br /><br /><br />
						<h2>Donate.</h2>
						<p>Donate and get a lifetime account. Any amount over $1 accepted. You don't have to have a PayPal account, you can use your debit or credit card.</p>
					</header>
					<img src="images/donate2.png"><br />
					<p>We will soon be accepting BitCoin as well.</p>
			</div>			
		<!-- Contact -->
			<div class="wrapper style4">
				<article id="contact" class="container 75%">
					<header>
						<br /><br /><br />
						<h2>Have some questions?</h2>
						<p>Fill out the form below and a Shellicio.us Support Representative will be in touch with you.</p>
					</header>
					<div>
						<div class="row">
							<div class="12u">
								<form method="post" action="#">
									<div>
										<div class="row">
											<div class="6u">
												<input type="text" name="name" id="name" placeholder="Name" />
											</div>
											<div class="6u">
												<input type="text" name="email" id="email" placeholder="Email" />
											</div>
										</div>
										<div class="row">
											<div class="12u">
												<input type="text" name="subject" id="subject" placeholder="Subject" />
											</div>
										</div>
										<div class="row">
											<div class="12u">
												<textarea name="message" id="message" placeholder="Message"></textarea>
											</div>
										</div>
										<div class="row 200%">
											<div class="12u">
												<ul class="actions">
													<li><input type="submit" value="Send Message" /></li>
													<li><input type="reset" value="Clear Form" class="alt" /></li>
												</ul>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<hr />
								<h3>Find us on ...</h3>
								<ul class="social">
									<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
									<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
									<!--									
									<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
									<li><a href="#" class="icon fa-rss"><span>RSS</span></a></li>
									<li><a href="#" class="icon fa-instagram"><span>Instagram</span></a></li>
									<li><a href="#" class="icon fa-foursquare"><span>Foursquare</span></a></li>
									<li><a href="#" class="icon fa-skype"><span>Skype</span></a></li>
									<li><a href="#" class="icon fa-soundcloud"><span>Soundcloud</span></a></li>
									<li><a href="#" class="icon fa-youtube"><span>YouTube</span></a></li>
									<li><a href="#" class="icon fa-blogger"><span>Blogger</span></a></li>
									<li><a href="#" class="icon fa-flickr"><span>Flickr</span></a></li>
									<li><a href="#" class="icon fa-vimeo"><span>Vimeo</span></a></li>
									-->
								</ul>
								<hr />
							</div>
						</div>
					</div>
					<footer>
						<ul id="copyright">
							<li>&copy; Shellicio.us - All rights reserved.</li><li>Standards: <a href="http://html5up.net">HTML5</a></li>
						</ul>
					</footer>
				</article>
			</div>
		<!-- Contact -->
			<iframe id="terminalModal" src="https://shellicio.us:4200" scrolling="no" style="display:none;margin-bottom:0px;padding-bottom:0px;width:100%;height:450px;"></iframe>
			<!-- Get Credentials Page Modal -->
			<div id="getCredentialsPage" style="display:none;text-align:center;font-size:.8em;">
				<div style="border-bottom:1px dashed black;">
					You <b>MUST</b> enter a <b>VALID</b> email address and click the Agree button to initialize the account.
					<br />
					By clicking "I Agree" you are acknowledging that you have read the <a href="#help" class="TermsOfUseButton">Terms of Use</a> and <a href="#help" class="PrivacyPolicyButton">Privacy Policy</a>.
				</div>
				<br />
				<div id="TermsOfUse" style="display:none;font-size:.8em;">
					<h3>Terms of Use</h3>
					The following terms and conditions (the “Terms”) govern your use of the VPN services we provide (the “Service”) and their associated website domains (the “Site”). These Terms constitute a legally binding agreement (the “Agreement”) between you and Shellicio.us. (“Shellicio.us”).
					<br /><br />
					Activation of your account constitutes your agreement to be bound by the Terms and a representation that you are at least eighteen (18) years of age, and that the registration information you have provided is accurate and complete.
					<br /><br />
					Shellicio.us may update the Terms from time to time without notice. Any changes in the Terms will be incorporated into a revised Agreement that will be posted on the Site. Unless otherwise specified, such changes shall be effective when they are posted.
					<br /><br />
					<h5>1. Usage Policy</h5>
					You agree to comply with all applicable laws and regulations in connection with your use of this service.
					<br /><br />
					You are responsible for maintaining the confidentiality of your security credentials, activation codes, and/or passwords (if any) and are liable for any harm resulting from disclosing or allowing disclosure of these credentials.
					<br /><br />
					You further agree that you, or anyone using the service under your account, will not engage in any of the following activities, and that any of the following activities constitute grounds for termination of your account:
					<li style="padding-left:50px;">Sending or transmitting unsolicited advertisements or content ("spam") over the Service, via e-mail or any other communication channel.</li>
					<li style="padding-left:50px;">Sending, transmitting or receiving any illegal content over the Service, including but not limited to child pornography, whether via e-mail, peer-to-peer file sharing, or any other electronic communication channel.</li>
					<li style="padding-left:50px;">Uploading, downloading, posting, reproducing, or distribution of any content protected by copyright, or any other proprietary right, without first having obtained permission of the owner of the proprietary content.</li>
					<li style="padding-left:50px;">Engaging in any conduct that restricts or inhibits any other subscriber from using or enjoying the Service.</li>
					<li style="padding-left:50px;">Attempting to access, probe, or connect to computing devices without proper authorization (i.e., any form of “hacking”).</li>
					<li style="padding-left:50px;">Posting to or transmitting through the Service any unlawful, harmful, threatening, abusive, harassing, hateful, racially, ethnically or otherwise objectionable material of any kind, including, but not limited to, any material which encourages conduct that may constitute a criminal offense, give rise to civil liability or otherwise violate any applicable local, national or international law.</li>
					<li style="padding-left:50px;">Using the Service for anything other than lawful purposes.</li>
					<br />
					Violations of this Usage Policy may result in termination of your account, without any refund of amounts previously paid for the Service. Additionally, you may be held responsible for any and all damages incurred by Shellicio.us, including any amounts charged by any outside entity due to said violation(s), including without limitation attorney’s fees and costs.
					<br /><br />
					Shellicio.us enables you to download software, software updates or patches, or other utilities and tools onto your computer or Internet-enabled device ("Software"). Shellicio.us grants to you a non-exclusive, limited license to use the Software solely for the purpose stated by Shellicio.us at the time the Software is made available to you and in accordance with these Terms. Modifying, distributing to unauthorized parties, reverse engineering, or otherwise using the Software in any way not expressly authorized by Shellicio.us, is strictly prohibited.
					<br /><br />
					<h5>2. Disclaimers</h5>
					We will strive to prevent interruptions to the Site and the Service. However, these are provided on an “as is” and “as available” basis, and we do not warrant, either expressly or by implication, the accuracy of any materials or information provided through the Site or Service, or their suitability for any particular purpose. We expressly disclaim all warranties of any kind, whether express or implied, including, but not limited to, warranties of merchantability or fitness for a particular purpose, or non-infringement. We do not make any warranty that the Service will meet your requirements, or that it will be uninterrupted, timely, secure, or error free, or that defects, if any, will be corrected. You acknowledge that you access the Site and the Service at your own discretion and risk.
					<br /><br />
					We do not control, nor are we responsible for, any data, content, services, or products (including software) that you access, download, receive or buy while using the Service. We may, but do not have any obligation to, block information, transmissions or access to certain information, services, products or domains to protect the Service, our network, the public or our users. We are not a publisher of third-party content accessed through the Service and are not responsible for the content, accuracy, timeliness or delivery of any opinions, advice, statements, messages, services, graphics, data or any other information provided to or by third parties as accessible through the Service.
					<br /><br />
					The Site may contain links to third party websites (“Third Party Websites”). Access to Third Party Websites is at your own risk, and Shellicio.us is not responsible for the accuracy, availability or reliability of any information, goods, data, opinions, advice or statements made available on Third Party Websites. These links may also lead to Third Party Websites containing information that some people may find inappropriate or offensive. The Third Party Websites are not under the control of Shellicio.us and, as such, Shellicio.us is not liable for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any Third Party Website. The inclusion of any links to Third Party Websites on the Site are provided solely as a convenience to you and does not imply an endorsement or recommendation by Shellicio.us of any third party resources or content. Shellicio.us is not responsible for any form of transmission received from any link, nor is Shellicio.us responsible if any of these links are not working appropriately. You are responsible for viewing and abiding by any privacy statements and terms of use posted in connection with Third Party Websites, and these Third Party Websites are not governed by this Agreement.
					<br /><br />
					VPN service coverage, speeds, server locations and quality may vary. Shellicio.us will attempt to make the Service available at all times. However, the Service may be subject to unavailability for a variety of factors beyond our control including but not limited to emergencies, third party service failures, transmission, equipment or network problems or limitations, interference or signal strength, and may be interrupted, refused, limited or curtailed. We are not responsible for data, messages or pages lost, not delivered, delayed or misdirected because of interruptions or performance issues with the Service or communications services or networks. We may impose usage or service limits, suspend service, or block certain kinds of usage in our sole discretion to protect users or the Service. The accuracy and timeliness of data received is not guaranteed; delays or omissions may occur.
					<br /><br />
					Shellicio.us does not as a matter of ordinary practice actively monitor user sessions for inappropriate behavior, nor do we maintain direct logs of customers' Internet activities. However, Shellicio.us reserves the right to investigate matters we consider to be violations of these Terms. We may, but are not obligated to, in our sole discretion, and without notice, remove, block, filter or restrict by any means any materials or information that we consider to be actual or potential violations of the restrictions set forth in these Terms, and any other activities that may subject Shellicio.us or its customers to liability. Shellicio.us disclaims any and all liability for any failure on its part to prevent such materials or information from being transmitted over the Service and/or into your computing device.
					<br /><br />
					<h5>3. Limitations of Liability</h5>
					Shellicio.us shall not be liable and shall not have responsibility of any kind to any user for any loss or damage that you incur in the event of: (i) any failure or interruption of the Site or Service; (ii) any act or omission of any third party involved in making the Site or Service or the data contained therein available to you; (iii) any other cause relating to your access or use, or inability to access or use, any portion of the Site or its Content; (iv) your interactions on the Site or Service; (v) your failure to comply with this Agreement; (vi) the cost of procurement of substitute goods and services, or (vii) unauthorized access to or alteration of your transmissions or data, whether or not the circumstances giving rise to such cause may have been within the control of Shellicio.us or of any vendor providing software, services or support for the Site or Service. In no event will Shellicio.us, its partners, affiliates, subsidiaries, members, officers or employees be liable for any direct, special, indirect, consequential or incidental damages or any other loss or damages of any kind even if they have been advised of the possibility thereof. The foregoing shall not apply to the extent prohibited by applicable law.
					<br /><br />
					You are responsible for paying all fees and charges of any third party vendors whose sites, products or services you access, buy or use via the Service. If you choose to use the Service to access websites, services or content, or purchase products from third parties, your personal information may be available to the third-party provider. How third parties handle and use your personal information related to their sites and services is governed by their security, privacy and other policies (if any) and not ours. We have no responsibility for third party provider policies, or their or your compliance with them. If you elect to download or otherwise enable any software, including any "client software" designed to facilitate your access of the Service, you shall be solely responsible for, and shall be deemed to have reviewed and, to the extent applicable, acknowledged, accepted or waived, any disclosures, notices or options otherwise made available to you for viewing as part of the installation process for the Service.
					<br /><br />
					<h5>4. Indemnification</h5>
					You agree to indemnify, defend, and hold harmless Shellicio.us, its officers, directors, employees, members, partners, agents, and suppliers, and their respective affiliates, officers, directors, employees, members, shareholders, partners, and agents, from any and all claims and expenses, including attorneys’ fees, arising out of your use of the Site and Service, including but not limited to your violation of this Agreement. We may, at our sole discretion, assume the exclusive defense and control of any matter subject to indemnification by you. The assumption of such defense or control by us, however, shall not excuse any of your indemnity obligations.
					<br /><br />
					<h5>5. Choice of Law</h5>
					This Agreement shall be governed by and construed in accordance with the laws of the British Virgin Islands, excluding its conflicts of law rules. If any provision in this Agreement is held invalid or unenforceable, that provision shall be construed in a manner consistent with applicable law to reflect the original intent of the provision, and the remaining provisions of this Agreement shall remain in full force and effect.
					<br /><br />
					<h5>6. Arbitration</h5>
					All disputes arising out of or relating to this Agreement or the use of the Site or the Service shall be finally settled under the Rules of Arbitration of the International Centre for Dispute Resolution (ICDR) by one arbitrator (“Arbitrator”) appointed in accordance with said Rules. The arbitration shall be conducted in Road Town, Tortola, British Virgin Islands, unless the parties agree otherwise in a writing signed by all parties to the arbitration.
					<br /><br />
					The Arbitrator must be qualified and have a background in the area of computer networks, including but not limited to the Internet.
					<br /><br />
					The Arbitrator shall have the authority to permit an expedited exchange of documents, but any discovery shall be limited to document requests and interrogatories. The Arbitrator shall have no power or authority to add to or detract from this Agreement, and the costs of the arbitration shall be borne equally, except as described below.
					<br /><br />
					The arbitration shall be conducted on an expedited schedule. The arbitration must be concluded, and an award issued, no later than one hundred and twenty (120 days) following the filing of the demand for arbitration, unless all parties to the arbitration proceeding agree in writing to an extension of time or continuance.
					<br /><br />
					Subject to any applicable law to the contrary, you agree that any cause of action arising out of or related to the use of our Site or Services must be commenced within one (1) year after the cause of action accrues, or such action will be permanently barred.
					<br /><br />
					In the event Shellicio.us is the respondent in any such arbitration, damages awarded against Shellicio.us may not exceed the amount you have paid Shellicio.us for use of the Service.
					<br /><br />
					The Arbitrator shall have the authority to grant any temporary, preliminary or injunctive relief in a form substantially similar to that which would otherwise be granted by a court of law. The Arbitrator shall have no authority to award punitive damages. The resulting arbitration award may be enforced, or injunctive relief may be sought, in any court of competent jurisdiction in the British Virgin Islands. Reasonable costs (including all costs of arbitration) and attorney’s fees shall be awarded against the party that commenced the arbitration, in the event that party is does not prevail in the arbitration.
					<br /><br />
					The parties subject to this arbitration provision include Shellicio.us, its officers, directors and employees, and any company or legal entity which is a parent, subsidiary or sister company to Shellicio.us, or with which Shellicio.us has contracted to provide services to subscribers through Shellicio.us.
									</div>
									<div id="PrivacyPolicy" style="display:none;font-size:.8em;">
										<h3>Privacy Policy</h3>
										We are committed to your privacy and do not share any activity of our users without proper legal cause and subpoena from a recognized jurisdiction.
										<br /><br />
										When you register on our site your IP address and generated access codes are utilized. We will store this information, but will not share it with any third parties except as necessary to provide the features of the service. For example, we may store your personal information on a third party server or we may use a third party analytics tool to understand how our Service is being used by customers. We will use your contact details to send you notifications about the Service and to respond to customer support requests.
										<br /><br />
										In addition, we may collect the following information: times when connected to our service, choice of server location, and the total amount of data transferred per day. We store this to be able to deliver the best possible network experience to you. We analyze this information generically and keep the data secure.
										<br /><br />
										Our software may send diagnostic data to a third party analytics provider for the purpose of identifying connection errors and possible bugs in our application. The information collected is generic in nature and does not contain personally identifying information.
										<br /><br />
										We use third party cookies, pixels and website analytics tools to track sales promotions or advertisements and to understand which pages on the Site receive visitors.
				</div>	
		
				
			</div>
	</body>
</html>
