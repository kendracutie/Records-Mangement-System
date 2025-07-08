<?php
session_start();
$isLoggedIn = isset($_SESSION['username']) ? 'true' : 'false';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sacraments</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/sacraments.css">

             <!-- SweetAlert2 CSS -->
             <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Full jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open">
        <i class="icon_menu"></i>
    </div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="icon_close"></i>
        </div>
      
        <nav class="mainmenu mobile-menu">
            <ul>
                <li ><a href="./index.php">Home</a></li>
                <li><a href="#">About</a>
                    <ul class="dropdown">
                        <li><a href="mv.php">Mission/Vision</a></li>
                        <li><a href="history.php">Parish History</a></li>
                        <li><a href="image.php">St. John Mary Vianney Image</a></li>
                        <li><a href="priest.php">Parish Priest</a></li>
                        <li><a href="event.php">Event Calendar</a></li>
                        <li><a href="FAQ.php">FAQ</a></li>
                
            </ul>
            <li class="active"><a href="#">Parish</a>
                <ul class="dropdown">
                    <li><a href="sacraments.php">Sacraments</a></li>
                    <li><a href="pb.php">Pastoral Board</a></li>
                    <li><a href="pt.php">Pastoral Team</a></li>
                    <li><a href="os.php">Office & Staff</a></li>
                </ul>
            </li>
            <li><a href="#">Devotion</a>
                <ul class="dropdown">
                    <li><a href="sjmv.php">St. John Mary Vianney</a></li>
                    <li><a href="nov.php">The Novena</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    <li><a href="hw.php">Holy Week in SJMV</a></li>
                </ul>
            </li>
            <li><a href="./prayer.php">Prayer Request</a></li>
            <li><a href="#">Certificate Request</a></li>
            <li><a href="./contact.php">Contact</a></li><br><br>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <ul class="top-widget">
            <li><a href="https://www.facebook.com/johnmarievianneyparish"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://x.com/StJohnVianneySc"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fa fa-instagram"></i></a></li>
            <li><a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fa fa-chrome"></i></a></li>
            <li><a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fa fa-youtube-play"></i></a></li>
        </ul>
    </div>
    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="top-nav">
            <div class="container">
                <div class="logo">
                    <a href="index.php">
                        <img src="logo.jpg" alt="Logo">
                    </a>
                </div>
               
            </div>
  
        <div class="menu-item">
            <div class="container">
                <div class="row">
                   
                    <div class="col-lg-12">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li><a href="./index.php">Home</a></li>
                                    <li><a href="#">About</a>
                                        <ul class="dropdown">
                                            <li><a href="mv.php">Mission/Vision</a></li>
                                            <li><a href="history.php">Parish History</a></li>
                                            <li><a href="image.php">St. John Mary Vianney Image</a></li>
                                            <li><a href="priest.php">Parish Priest</a></li>
                                            <li><a href="event.php">Event Calendar</a></li>
                                            <li><a href="FAQ.php">FAQ</a></li>

                                        </ul>
                                    </li>
                                    <li class="active"><a href="#">Parish</a>
                                        <ul class="dropdown">
                                            <li><a href="sacrements.php">Sacraments</a></li>
                                            <li><a href="pb.php">Pastoral Board</a></li>
                                            <li><a href="pt.php">Pastoral Team</a></li>
                                            <li><a href="os.php">Office & Staff</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Devotion</a>
                                        <ul class="dropdown">
                                            <li><a href="sjmv.php">St. John Mary Vianney</a></li>
                                            <li><a href="nov.php">The Novena</a></li>
                                            <li><a href="gallery.php">Gallery</a></li>
                                            <li><a href="hw.php">Holy Week in SJMV</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="./prayer.php">Prayer Request</a></li>
                                    <li><a href="#" id="reqCertificate">Certificate Request</a></li>
                                    <li><a href="./contact.php">Contact</a></li>

                                </ul>
                                <div class="top-social">
                                    <a href="https://www.facebook.com/johnmarievianneyparish"><i class="fa fa-facebook"></i></a> 
                                    <a href="https://x.com/StJohnVianneySc"><i class="fa fa-twitter"></i></a>
                                    <a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fa fa-instagram"></i></a>
                                    <a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fa fa-chrome"></i></a>
                                    <a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fa fa-youtube-play"></i></a>
                                 </div>
                                 <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "user") { ?>
                                    <div class="dropdownn">
                                        <a class="nav-link dropdown-toggle navbar-text" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white;">
                                            <i class="fas fa-user-circle icon-spacing"></i><?php echo htmlspecialchars($_SESSION['username']); ?>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                            
                                            <!-- Link to edit personal information -->
                                            <a class="dropdown-item item" href="edit_personal_info.php">
                                                <i class="fas fa-user-edit"></i> Edit Personal Information
                                            </a>

                                            <!-- Link to change password -->
                                            <a class="dropdown-item item" href="change_password.php">
                                                <i class="fas fa-key"></i> Change Password
                                            </a>

                                            <!-- Link to certificate request history -->
                                            <a class="dropdown-item item" href="request_history.php">
                                                <i class="fas fa-history"></i> Certificate Request History
                                            </a>

                                            <!-- Logout button with confirmation -->
                                            <a href='../web-sjmv/logout.php' onclick='confirm_logout(event, this.href)' title='Logout' class='dropdown-item item'>
                                                <i class='fas fa-sign-out-alt'></i> Logout
                                            </a>
                                        </div>

                                        </div>
                                    <?php } ?>
                            </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->
    <style>
.dropdownn {
    position: absolute;
    top: 23px;
    right: -120px;
}

.icon-spacing {
    margin-right: 5px; /* Adjust the value as needed */
}

.dropdown-menu {
    margin-top: 16px;
    min-width: 240px; /* Set a minimum width for the dropdown */
    height: 240px; /* Fixed height for the dropdown */
    border-radius: 0.5rem; /* Rounded corners */
    margin-right: -20px;
}

.navbar-text {
    display: flex; /* Use flex for better alignment */
    align-items: center; /* Center align items */
}

.dropdown-item.item {
    color: maroon; /* Set the logout link color to maroon */
    text-decoration: none; /* Optional: remove underline */
    outline: none; /* Remove default outline for focused links */
    padding: 15px; /* Add padding for better spacing */
}

/* Normal state */
.item {
    color: maroon; /* Set the link color to maroon */
    text-decoration: none; /* Optional: remove underline */
    outline: none; /* Remove default outline for focused links */
}

/* Hover state */
.item:hover {
    color: #800000; /* Darker shade of maroon on hover (optional) */
}

/* Active and focus state */
.item:active, .item:focus {
    color: maroon; /* Keep maroon color when clicked or focused */
    outline: none; /* Remove the default outline (focus state) */
    text-decoration: none;
    background-color: transparent; /* Ensure no background color change */
}
</style>

  <!-- Sacraments content begin here -->
   
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
             <h2>All<span class="black-text"> </span><span class="maroon-text">Sacraments</span></h2>
             <div class="grid-container">
                
                <div class="sacrament" data-requirements="<h6><b>MGA MADALAS NA KATANUNGAN SA SAKRAMENTO NG BINYAG<b></h6><br><br><p>

                    
                    
                     
                    
                    1. <b><u><mark>ARAW NG SEMINAR AT BINYAG<mark></u></b><br>
                    By Appointment<i> (Every Tuesday-Saturday only)</i><br>
                    8:30 AM - 12NN  1:30 PM - 5:30 PM <br>
                    BREAKTIME (12NN - 1:30 PM)<br>
                    
                    Isang Batch lamang po ang Binyag.<br><br><br>
                    
                  
                    
                     
                    
                    2. <b><u><mark>ARAW NG PAGPAPALISTA<mark></u></b><br>
                    <b>Tuesday-Saturday</b> <i>(First come, first serve basis)</i><br>
                    
                   <i> Office Hours</i>:<br>
                    
                   <b> MORNING         –       8:30 AM to 12:00 NN</b><br>
                    
                    <b>AFTERNOON     –       1:30 PM to 5:30 PM</b><br><br><br>
                    
                     
                    
                    3. <b><u><mark>MGA DOKUMENTONG DAPAT DALHIN SA PAGPAPATALA</mark></u></b><br>
                    Ang mga requirements ay dapat dalhin at ipakita muna sa Records Office sa araw ng pagpapatala upang masiguro na maisasama ang inyong pabibinyagan sa mga nakatakda.<br><br>
                    
                    <li> 0 to 11 months (<b>Livebirth</b>) <i>xerox</i></li>
                    <li> 1 - 6 years old (<b>PSA</b>) <i>xerox</i></li>
                    <li>sponsors: ninong/ninang (<b>16 up</b>) <i>Catholic</i></li><br><br>

                    
                    1.<b><mark> KUNG HINDI KASAL ANG MGA MAGULANG NG BATA</b></mark><br><br><br>
                     
                    
                    Orihinal na kopya ng <b><i>Registered Birth Certificate</b></i> ng batang bibinyagan
                    na galing sa City Hall o di naman kaya ay sa NSO/PSA.<br><br>
                    
                     
                    
                    <b>Hindi po natin maaring tanggapin ang galing sa Ospital
                    
                    na hindi pa narerehistro</b>.<br><br><br>
                    
                     
                    
                    Kung ang bata ay naka-apelyido na sa Ama, hilingin sa Munisipyo na maisama
                    
                    ang kopya ng  <u>ACKNOWLEDGEMENT OF FATERNITY</u> na matatagpuan sa likod na bahagi ng <i>Birth Certificate</i> na nagpapatunay sa pagpayag ng Ama na gamitin na kanyang apelyido kahit na hindi pa siya naikakasal sa Ina ng bata.<br><br><br>
                    
                     
                    
                    <b><i>Certificate of Residency</i></b>  mula sa barangay kung saan nakatira ang magulang ng batang bibinyagan na sakop ng St. John Mary Vianney Parish.<br><br><br>
                     
                    
                    1. <b><mark>KUNG KASAL NA ANG MAGULANG NG BATA</b></mark<<br><br>
                     
                    
                    Registered <b><i>Marriage Contract</i></b>(<b>Xerox</b>) ng mga magulang na galing din sa Munisipyo o sa NSO.<br><br>
                     
                    
                    1. <b><mark>KUNG HINDI RESIDENTE/PARISHIONER NG SJMV Parish</b></mark><br><br>
                     
                    
                    Sertipiko ng pagpapahintulot ng Simbahang kinasasakupan ng inyong tahanan
                   <b><i> Permit to Baptize Certificate</i></b> na magmumula sa simbahang pinakamalapit sa inyong tahanan.<br><br><br>
                    
                     
                    
                    Makipag ugnayan lamang sa RECORDS OFFICE ng SJMV Parish upang malaman ang simbahang kinasasakupan ng inyong tahanan.</p>">
                    <img src="./img/sacraments/baptism.jpeg" alt="Baptism">
                    <p>Baptism</p><p class="hover-text">See more...</p>
                </div>
                <div class="sacrament" data-requirements="<h6><b>MGA MADALAS NA KATANUNGAN SA SAKRAMENTO NG KUMPIL<b></h6><br><br><p>

                    
                    
                    1. <b><u><mark>ARAW NG PAGPAPALISTA<mark></u></b><br>
                    <b>Tuesday-Saturday</b><br>
                    
                   <i> Office Hours</i>:<br>
                    
                   <b> MORNING         –       8:30 AM to 12:00 NN</b><br>
                    
                    <b>AFTERNOON     –       1:30 PM to 5:30 PM</b><br><br><br>
                
                 Tanging ang MAGPAPAKUMPIL lamang ang pahihintulutang magpatala.<br><br>
                
                 
                
                2.<b><u><mark> ANO ANG MGA DOKUMENTONG DAPAT DALHIN SA PAGPAPATALA / PAGPAPALISTA?</b></u></mark><br><br>
                

                
                
                1. <b><mark>PARA SA MGA IKAKASAL</b></mark>:<br>
                <b>NEWLY ISSUED BAPTISMAL CERTIFICATE<br>
                
                WITH ANNOTATION “For Confirmation Purposes”<br>
                
                & RECEIPT OF CERTIFICATE<br>
                
                (BRING THE ORIGINAL COPY AND PHOTOCOPY)</b><br><br>
                
                 
                
                <i>Bagong Kopya ng Sertipiko ng Binyag na may nakasulat na
                
                “For Confirmation Purposes”
                
                dalhin ang orihinal na kopya at ang resibo para sa verification.</i><br><br>
                
                 
                
                <b><u>Mga ibang kailangan depende sa dokumentong isusumite</u></b>:<br><br>
                
                 
                
                <b><mark>KUNG NABINYAGAN SA EDAD NA 12 PATAAS<mark></b>:<br>
                                  <b> Certificate of No Record of Confirmation</b><br>
                
                <i>Ito’y mula sa simbahan kung saan bininyagan upang patunayan na hindi pa nakukumpilan.</i><br><br>
                
                 
                
                <b><mark>KUNG NABINYAGAN LAMANG SA NAKALIPAS NA BUWAN O TAON
                     DAHIL SA MAGPAPAKASAL NA.</mark></b><br>
                
                                  <b><i> Certificate of Explanation from the Parish</i><b><br>
                
                <i>Sulat pagpapaliwanag mula sa Parokya kung saan bininyagan.<br>
                
                Ito’y naglalahad na noong ikaw ay bininyagan ay hindi isinama ang Sakramento ng Kumpil.</i><br><br>
                
                 
                
                <b><mark>Bakit kailangan nito?</mark><b><br>
                
                <i>Ang taong matanda na at nagpabinyag dahil sa ilang mga kadahilanan ay dapat tatanggap ng tinatawag na “Sacrament of Initiation” kung saan dapat kasama ang Binyag, Kumpil at pagtanggap sa banal na komunyon sa isang rito (rites) lamang.</i><br><br>
                
                 
                
                1.<b> PARA SA MGA BATANG MAY EDAD 12 PATAAS AT HINDI NAMAN IKAKASAL:
                NEWLY ISSUED BAPTISMAL CERTIFICATE<br>
                
                WITH ANNOTATION <i>“For Confirmation Purposes”</i><br>
                
                & RECEIPT OF CERTIFICATE<br>
                
                (BRING THE ORIGINAL COPY)</b><br><br>
                
                3. <b><u><mark>SINO ANG MGA MAAARING MAGING NINONG O NINANG AT ILAN ANG KINAKAILANGAN?</b></u></mark><br>
                <b>ISANG TAO LAMANG ANG ATING PINAHIHINTULUTAN<br><br>
                
                na makasama o maging sponsor ng kukumpilan.</b><br><br><br>
                
                 
                
                Kinakailangan Siya ay isang Binyagang Katoliko at nakatangap na ng Sakramento ng Kumpil.
                Mga tiyuhin o tiyahin, Ninong o Ninang sa binyag o sa kasal ang mga maari ninyong kunin.
                Mas kaaya-aya na nakatangap na rin ng sakramento ng Kasal kung sila ay
                may asawa na.<br><br><br>
                
                 
                
                <b><mark>MGA HINDI MAARING GAWING NINONG O NINANG</mark><b><br><br>
                
                <li>Ang iyong mapapangasawa (Fiancée)</li>
                <li>Ang iyong mga magulang at kapatid (Parents & Siblings)</li>
                <li>Ang iyong mga hipag o bayaw (In-Laws)</li>
                <li>Ang iyong magigin biyenan (Father-in-Law / Mother-in-Law)</li>
                <li>Ang senior citizen (may edad na 60 pataas)</li><br><br>
                 
                
                4. <b><u><mark>KAILAN MAAARING MAKUHA ANG SERTIPKO NG KUMPIL?</b></u></mark><br>
                <b>Ang Confirmation Certificate ay makukuha</b><br><br>
                
                <b>ISANG LINGGO MATAPOS ANG KUMPIL <i>(1 Week after Confirmation)</i></b><br>
                
                Mangyari lamang na tignan ang impormasyon sa pagkuha ng Sertipiko.<br><br><br>
                
                 
                
                5.<b><u><mark> MAY BAYAD BA ANG SAKRAMENTO NG KUMPIL?</b></u></mark><br>
                <b>“ANG MGA SAKRAMENTO AY WALANG BAYAD”</b><br><br>
                
                Mayroon lamang pong <b>KUSANG LOOB NA DONASYON</b> na hinihingi po sa atin bilang kontribusyon natin sa pag-gamit ng pasilidad, speakers, Atbp.<br>
                
                 Nasasaad po sa ating Biblia na responsibilidad nating mga Kristiyano ang suportahan ang ating Simbahan. Ikinalulugod ng Panginoon ang isang pusong mapagbigay …
                
                <i>“Ang bawat isa’y dapat magbigay ayon sa sariling pasya, maluwag sa loob at di napipilitan lamang, sapagkat ang pag-ibig ng Diyos ay kusang pagkakaloob …”
                
                2 Cor. 9:7</i><br><br><br>
                
                
                <b><u><mark>MGA PAALALA SA MGA MAGPAPATALA</b></u></mark><br><br>
                
                <b>NG BINYAG / KUMPIL</b><br><br>
                
                1. Kung ang inyong Baptismal record ay may mali <i>(discrepancy)</i> tulad ng spelling ng pangalan, detalye ng mga magulang, birthday, atbp. mangyari lamang na ipaayos/ipa-correct muna ito sa simbahang pinagbinyagan bago magpalista ng Kumpil upang maiwasan na madagdagan ang pagkakamali sa inyong record. Huwag po tayong magpapagawa ng Affidavit of Discrepancy,
                ang simbahan ang siyang tutulong sa inyo.<br>
                
                2. Mangyari lamang na suriin muna ang Baptismal Certificate bago umalis ng simbahan pinagkuhaan kung ito ba ay nilagdaan (signature) ng Parish Priest, dry seal, mahalaga rin na nakalagay ang petsa kung kailan ini-issue ang Certificate at ang resibo nito.<br>
                
                3. Mangyari lamang na mag-suot tayo ng TAMANG PANANAMIT na angkop sa ating pupuntahan, hindi po natin pinahihintulutan na makapag palista o kumuha ng sertipiko ang mga naka (Shorts, Slippers, Sleeveless, Sando)">
                    <img src="./img/sacraments/confirmation.jpg" alt="Marriage">
                    <p>Confirmation</p><p class="hover-text">See more...</p>
                </div>
                <div class="sacrament" data-requirements="<h6><b>MGA MADALAS NA KATANUNGAN SA SAKRAMENTO NG KASAL<b></h6><br><br><p>

                    
                    
                     
                    
                    1. <b><u><mark>SCHEDULES<mark></u></b><br>
                    By Appointment<i> (Every Tuesday-Saturday only)</i><br>
                    8:30 AM - 12NN  1:30 PM - 5:30 PM <br>
                    BREAKTIME (12NN - 1:30 PM)<br><br>
                
                 
                
                <b><u><mark>NEEDED DOCUMENTS(GROOM AND BRIDE)</b></u></mark><br><br>
                1.Both Catholic<br>
                2.Not married in civil <br>
                3.Marriage License & Certificate of No Marriage (CeNoMar)<br>
                4.Marriage License<br>
                5.Original Birth Certificate from NSO/PSA<br>
                6.Baptismal Certificate(annotation for marriage) 6 months valid<br>
                7.Confirmation Certificate(for marriage purposes)<br>
                8. 2x2 pictures<br>
                9.Sponsors (All Catholic)<br>
                10. Marriage Permit (Parish)<br>
                11.Information of whose form(name, address, parokya)<br>
                12.Good Moral<br><br> 
                

                <b><mark><i>PRE – CANA SEMINAR<br>
                CANONICAL INTERVIEW<br>
                SIGNED AGREEMENT – RULES & REGULATIONS FOR WEDDING<br>
                SACRAMENT OF RECONCILIATION (Confession).</b></mark></i><br><br>
              
                <b><mark>For Widowed:</b></mark><br>
                
                Death Certificate of his/her wife or husband.">
                    <img src="./img/sacraments/marriage.jpg" alt="Marriage">
                    <p>Marriage</p><p class="hover-text">See more...</p>
                </div>
                <div class="sacrament" data-requirements="<b><mark>Isang mapagpalang araw!!</b></mark>
                <br> Ang schedule ng Confession ay mula <b>Martes</b> hanggang <b>Sabado</b>.<br><br>

                Nagsisimula ng <i><b>8:30 A.M</i></b> hanggang may pari na nagpapakumpisal<br>
                (minsan ay hanggang <i><b>5:30 P.M</i></b>)<br>
                
                Magpunta lamang po sa ating minamahal na simbahan ng <i><b>St. John Mary Vianney Parish</i></b>.<br>
                
                Maraming Salamat. Pagpalain kayo ni <b><i><mark>St. John Mary Vianney.</b></i></mark>">
                    <img src="./img/sacraments/confession.jpg" alt="Confession">
                    <p>Confession</p><p class="hover-text">See more...</p>
                </div>
                <div class="sacrament" data-requirements="<b><mark>SCHEDULES</b></mark><br><br>
                    <b> Monday, Wednesday - Satuday (<i>6:30 A.M</i>)<br><br>
                   <b>Tuesday (<i>5:30 P.M</i>)<br><br>
                   <b> Sunday(<i>8:00 A.M and 5 P.M</i>)
                    ">
                    <img src="./img/sacraments/AOTS.jpg" alt="Annointing of the sick">
                    <p>Annointing of the sick</p><p class="hover-text">See more...</p>
                    
                </div>
                <div class="sacrament" data-requirements="<b><mark>SCHEDULES</b></mark><br><br>
                    <b> Monday, Wednesday - Satuday (<i>6:30 A.M</i>)<br><br>
                   <b>Tuesday (<i>5:30 P.M</i>)<br><br>
                   <b> Sunday(<i>8:00 A.M and 5 P.M</i>)
                   ">
                    <img src="./img/sacraments/holyO.jpg" alt="Holy Orders">
                    <p>Holy Orders</p><p class="hover-text">See more...</p>
                </div>
                <div class="sacrament" data-requirements="<b><mark>SCHEDULES</b></mark><br><br>
                    <b> Monday, Wednesday - Satuday (<i>6:30 A.M</i>)<br><br>
                   <b>Tuesday (<i>5:30 P.M</i>)<br><br>
                   <b> Sunday(<i>8:00 A.M and 5 P.M</i>)
                   ">
                    <img src="./img/sacraments/holyE.jpg" alt="Holy Eucharist">
                    <p>Holy Eucharist</p><p class="hover-text">See more...</p>
                </div>
                <div class="sacrament" data-requirements="<b><u><mark>ANG MGA SAKRAMENTO AY WALANG BAYAD</b></u></mark><br><br><br>

 

                    Mayroon lamang pong<br><br>
                    
                    <b><mark>KUSANG LOOB NA DONASYON</b></mark><br><br>
                    
                    na hinihingi po sa atin bilang kontribusyon natin sa pag-gamit ng pasilidad,<br><br>
                    
                    speakers, at iba pa.<br><br><br>
                    
                     
                    
                    <b><u><mark> HINDI PO TINATANGGIHAN ANG WALANG PAMBAYAD </b></u></mark><br><br>
                    
                                     Nasasaad po sa ating Biblia na responsibilidad nating mga Kristiyano ang suportahan ang ating Simbahan. Ikinalulugod ng Panginoon ang isang pusong mapagbigay …<br>
                                    
                                    <i>“Ang bawat isa’y dapat magbigay ayon sa sariling pasya, maluwag sa loob at di napipilitan lamang, sapagkat ang pag-ibig ng Diyos ay kusang pagkakaloob …”
                                    
                                    2 Cor. 9:7</i><br><br><br>
                                    
                                    
                                    <b><u><mark>MGA PAALALA SA MGA MAGPAPATALA</b></u></mark><br><br>
                                    
                                    <b>NG BINYAG / KUMPIL</b><br><br>
                                    
                                    1. Kung ang inyong Baptismal record ay may mali <i>(discrepancy)</i> tulad ng spelling ng pangalan, detalye ng mga magulang, birthday, atbp. mangyari lamang na ipaayos/ipa-correct muna ito sa simbahang pinagbinyagan bago magpalista ng Kumpil upang maiwasan na madagdagan ang pagkakamali sa inyong record. Huwag po tayong magpapagawa ng Affidavit of Discrepancy,
                                    ang simbahan ang siyang tutulong sa inyo.<br>
                                    
                                    2. Mangyari lamang na suriin muna ang Baptismal Certificate bago umalis ng simbahan pinagkuhaan kung ito ba ay nilagdaan (signature) ng Parish Priest, dry seal, mahalaga rin na nakalagay ang petsa kung kailan ini-issue ang Certificate at ang resibo nito.<br>
                                    
                                    3. Mangyari lamang na mag-suot tayo ng TAMANG PANANAMIT na angkop sa ating pupuntahan, hindi po natin pinahihintulutan na makapag palista o kumuha ng sertipiko ang mga naka (Shorts, Slippers, Sleeveless, Sando)">
                                        
                <img src="./img/sacraments/reminders.jpg" alt="Reminders">
                <p>Reminders</p><p class="hover-text">See more...</p>

                </div>
            </div>
        
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p id="modal-description"></p>
                </div>
            </div>               
            </div>
        </div>
    </div>

  <!-- Sacraments content  End here -->
    <script>
        document.querySelectorAll('.sacrament').forEach(item => {
    item.addEventListener('click', function () {
        const requirements = this.getAttribute('data-requirements');
        document.getElementById('modal-description').innerHTML = requirements;
        document.getElementById('modal').style.display = 'block';
        document.body.classList.add('modal-open'); 
    });
});

document.querySelector('.close').addEventListener('click', function () {
    document.getElementById('modal').style.display = 'none';
    document.body.classList.remove('modal-open'); 
});


window.addEventListener('click', function (event) {
    const modal = document.getElementById('modal');
    if (event.target === modal) {
        modal.style.display = 'none';
        document.body.classList.remove('modal-open'); 
    }
});

    </script>
    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-text">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ft-about">
                            <div class="logoo">
                                <a href="#">
                                    <img src="logo.jpg" alt="">
                                </a>
                            </div>
                            <p>We inspire and reach thousands of Parishioner<br /> in San Leonardo</p>
                            <div class="fa-social">
                                <a href="https://www.facebook.com/johnmarievianneyparish"><i class="fa fa-facebook"></i></a> 
                                <a href="https://x.com/StJohnVianneySc"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.instagram.com/st.johnmariavianneyparish/"><i class="fa fa-instagram"></i></a>
                                <a href="https://www.parishph.com/2022/07/st-john-marie-vianney-parish-adorable.html"><i class="fa fa-chrome"></i></a>
                                <a href="https://www.youtube.com/@sjmvpyouthministry840"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="ft-contact">
                            <h6 style="color: white;">Contact Us</h6>
                            <ul>
                                <li>0915 554 2330</li>
                                <li>stjohnmarievianneyparish@gmail.com</li>
                                <li>Tambo Adorable, San Leonardo Nueva Ecija</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="ft-newslatter">
                            <h6 style="color: white;">New latest</h6>
                            <p>Get the latest updates and offers.</p>
                            <form action="#" class="fn-form">
                                <input type="text" placeholder="Email">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Js Plugins -->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/jquery.slicknav.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/main.js"></script>
 
  <script>
        document.addEventListener('DOMContentLoaded', function() {
        console.log("DOM fully loaded and parsed");

        // Get the login status passed from PHP
        const isLoggedIn = <?php echo $isLoggedIn; ?>; // Pass the boolean directly

        const requestCertLink = document.getElementById("reqCertificate");

        if (requestCertLink) {
        requestCertLink.addEventListener("click", function(e) {
            e.preventDefault();
            console.log("Request Certificate clicked");

            // Check if the user is logged in
            if (isLoggedIn) {
                // Redirect to the certificate request page if logged in
                window.location.href = "certificate_req.php";
            } else {
                // Show SweetAlert if not logged in
                Swal.fire({
                    title: '<span style="font-family: Arial, Helvetica, sans-serif; font-size: 22px; color:#2F4F4F;">Login Required</span>', // Custom title color
                    text: 'To request a certificate, you must log in or sign up first.',
                    icon: 'warning',
                    iconColor: '#ffcc00', // Custom icon color (yellow for warning)
                    showCancelButton: true,
                    confirmButtonText: 'Login / Sign Up',
                    cancelButtonText: 'Cancel',
                    backdrop: 'rgba(0, 0, 0, 0.6)',
                    confirmButtonColor: 'burlywood', // Custom confirm button color (dark green)
                    cancelButtonColor: '#630707',
                    background: '#fffef0' // Custom background color (light cream)
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../view/index.php"; // Redirect to login/signup page
                    }
                });
            }
        });
    } else {
        console.error("Element with ID 'reqCertificate' not found");
    }
});
</script>
<script>
$(document).ready(function() {
    // Ensure the dropdown works properly
    $('#userDropdown').on('click', function() {
        $(this).next('.dropdown-menu').toggle();
    });

    // Close the dropdown if clicking outside of it
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown-menu').hide();
        }
    });
});
</script>

<script>

    $(document).ready(function() {
    // Function to load certificate request history
    $('#certificateHistoryModal').on('show.bs.modal', function() {
        // Fetch and display the user's certificate request history from the server
        $.ajax({
            url: 'cert_req.php', // Adjust to your PHP script
            method: 'GET',
            success: function(data) {
                $('#certificateHistoryContent').html(data);
            }
        });
    });
});

</script>

<!-- Logout confirmation logic using SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirm_logout(event, url) {
    event.preventDefault(); // Prevent the default link action

    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to log out?',
        icon: 'warning',
        showCancelButton: true,
        background: '#fffef0', // Light cream background
        confirmButtonColor: 'burlywood', // Burlywood color for the confirm button
        cancelButtonColor: '#630707', // Maroon color for the cancel button
        confirmButtonText: 'Yes, log out!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url; // Redirect to the logout page if confirmed
        }
    });
}
</script>
</body>

</html>