<?php
include 'validation.php';

$error_name = "";
$error_color = "";
$error_size = "";
$monkeyName = "";
$monkeySize = "";
$colorHair = "#C86D5C";
$colorSkin = "#FBC4AC";
$colorClothes = "#F2C42C";
$colorBoots = "#3A484A";

if(isset($_POST['submit'])){

    $valid_form = true;

    $monkeyName = $_POST['monkey_name'];
    $monkeySize = $_POST['monkey_size'];

    $colorHair = $_POST['color_hair'];
    $colorSkin = $_POST['color_skin'];
    $colorClothes = $_POST['color_clothes'];
    $colorBoots = $_POST['color_boots'];


    if(!valid_name($monkeyName)){
        $valid_form = false;
        $error_name = "Please enter a name for your monkey";
    }
    if(!valid_size($monkeySize)){
        $valid_form = false;
        $error_size = "Select a size for your monkey";
    }

}
else{

}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Self-Posting Form Validation</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *,:after,:before{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}body{font:normal 15px/25px 'Open Sans',Arial,Helvetica,sans-serif;color:#444;text-align:left}h1,h2,h3{font-weight:400}h1{font:normal 40px/120px 'Open Sans',Arial,Helvetica,sans-serif;text-align:center;color:#444;margin:0}h1 span{color:#484c9b}h2{font-size:25px;line-height:30px;color:#484c9b;margin:50px 0 10px}h3{font-size:18px;line-height:35px;margin:50px 0 0}a{color:#484c9b;text-decoration:none}a:focus,a:hover{text-decoration:underline}p{margin:0 0 2rem}p span{color:#aaa}header{width:98%;margin:40px auto 0;border-bottom:1px solid #ddd;padding-bottom:40px;text-align:center}header p{margin:0}section{width:95%;max-width:910px;margin:40px auto}pre{background:#f9f9f9;padding:10px;font-size:12px;border:1px solid #eee;white-space:pre-wrap;border-radius:10px}table{border:1px solid #eee;background:#f9f9f9;width:100%;border-collapse:collapse;border-spacing:0;margin-bottom:3rem}thead{background:#5965af;color:#fff}tbody tr td,thead td{padding:.5rem .75rem}tbody tr:nth-child(even){background:#efefef}tbody tr td:first-child{padding-left:1.25rem}tbody tr td:first-child,tbody tr td:nth-child(3),thead td:first-child,thead td:nth-child(3){width:15%}tbody tr td:nth-child(2),thead td:nth-child(2){width:20%}tbody tr td:last-child,thead td:last-child{width:50%}@media only screen and (min-width:768px){body{font-size:20px;line-height:30px}h2{font-size:30px;line-height:45px}h3{font-size:22px;line-height:45px;margin-top:50px}p{margin-bottom:2rem}h1{font-size:60px}pre{padding:20px;font-size:15px}}
        #form-content {padding-bottom:5rem;display:flex;flex-wrap:wrap;justify-content:space-between;max-width:50rem;margin:0 auto;}
        #form-content div:first-child {width:100%;}
        .error {display:block;font-size:0.7rem;color:#cc0000;}
    </style>
</head>
<body>
    <header>
        <h1>WDV341 Intro <span>PHP</span></h1>
        <p>Unit-8 Self Posting Form With Validation</p>
    </header>
    <section>
        <div id="form-content">
            <div>
                <h3><strong>Monkey Form</strong></h3>
                <p>Let's name, color and validate a monkey!</p>
            </div>
            <form name="form1" id="form-1" method="post" action="self-post-validation.php">
                <p>
                    <span id="error-name" class="error"><?=$error_name?></span>
                    <label for="monkey-name">Monkey Name: </label>
                    <input type="text" name="monkey_name" id="monkey-name" value="<?=$monkeyName?>">
                </p>
                <p>
                    <span id="error-size" class="error"><?=$error_size?></span>          
                    <label for="monkey-size">Monkey Size: </label>
                    <select name="monkey_size" id="monkey-size" >
                        <option value="">Select Size</option>
                        <option value="sm" <?=$monkeySize == 'sm' ? 'selected' : '' ?>>Small</option>
                        <option value="md" <?=$monkeySize == 'md' ? 'selected' : '' ?> >Medium</option>
                        <option value="lg" <?=$monkeySize == 'lg' ? 'selected' : '' ?> >Large</option>
                    </select>
                </p>
                <p>
                    <span id="error-color" class="error"><?=$error_color?></span>
                    <label for="color-hair">Hair Color:</label>
                    <input type="color" value="<?= $colorHair ?>" name="color_hair" id="color-hair" /><br>
                    <label for="color-skin">Skin Color:</label>
                    <input type="color" value="<?= $colorSkin ?>" name="color_skin" id="color-skin" /><br>
                    <label for="color-clothes">Clothes Color:</label>
                    <input type="color" value="<?= $colorClothes ?>" name="color_clothes" id="color-clothes" /><br>
                    <label for="color-boots">Boots Color:</label>
                    <input type="color" value="<?= $colorBoots ?>" name="color_boots" id="color-boots" />
                </p>
                <p>
                    <input type="submit" name="submit" id="submit" value="Submit">
                    <input type="reset" name="Reset" id="button" value="Reset">
                </p>
            </form>

            <svg version="1.1" id="monkey" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <style type="text/css">
                    .st0{fill:<?= $colorBoots?>;}
                    .st1{fill:<?= $colorClothes ?>;}
                    .st2{fill:<?= $colorHair ?>;}
                    .st3{opacity:0.12;}
                    .st4{fill:<?= $colorSkin ?>;}
                </style>
                <g id="boots">
                    <path class="st0" d="M162.2,495.5c0.1-0.1,0.3-0.1,0.4-0.2c8-4.5,13.7-12.1,15.1-21.1c0.3-1.7,0.6-3.3,0.8-4.6l23.7-15.2l19.2,15.2
                    c-1.8,6.9-3.3,14.4-4.1,22c-1.3,11.6-11.1,20.4-22.8,20.4h-19.6v0h-8.1C157.7,512,154.4,500.1,162.2,495.5z" />
                    <path class="st0" d="M349.8,495.5c-0.1-0.1-0.3-0.1-0.4-0.2c-8-4.5-13.7-12.1-15.1-21.1c-0.3-1.7-0.6-3.3-0.8-4.6l-23.7-15.2
                    l-19.2,15.2c1.8,6.9,3.3,14.4,4.1,22c1.3,11.6,11.1,20.4,22.8,20.4h19.6v0h8.1C354.3,512,357.6,500.1,349.8,495.5z" />
                </g>
                <path class="st1" d="M41.8,43.2c-3.7,18.4,3,38.2,18.8,50.4s36.7,13.7,53.5,5.5c3.7-18.4-3-38.2-18.8-50.4S58.7,35,41.8,43.2z" />
                <path class="st2" d="M76.4,474.8c-8.7,0-17-1.5-24.3-4.6c-11.5-4.8-20.1-13-24.8-23.7c-4.8-10.9-5.4-23.9-1.5-37.7
                c2.3-8.4,10.9-13.2,19.3-10.9c8.3,2.3,13.2,11,10.9,19.3c-5.1,18.5,4.9,22.7,8.2,24.1c18.3,7.6,56.4-4.1,80.1-45.8
                c4.3-7.5,13.9-10.2,21.4-5.9c7.5,4.3,10.2,13.9,5.9,21.4C146.8,454.3,108.3,474.8,76.4,474.8z" />
                <path class="st2" d="M178.5,469.6h42.9c6.2-24.1,16.2-42.5,16.3-42.8c5.6-10.1,1.9-22.8-8.2-28.4c-10.1-5.6-22.8-1.9-28.4,8.1
                C200.3,408.1,185.6,434.9,178.5,469.6z" />
                <path class="st3" d="M229.5,398.4c-10.1-5.6-22.8-1.9-28.4,8.1c-0.7,1.3-10.3,18.8-17.7,43.7c11.8,7.3,24.8,13,38.8,16.5
                c6.2-22.7,15.4-39.6,15.6-39.9C243.3,416.7,239.6,404,229.5,398.4z" />
                <path class="st2" d="M333.5,469.6h-42.9c-6.2-24.1-16.2-42.5-16.3-42.8c-5.6-10.1-1.9-22.8,8.2-28.4c10.1-5.6,22.8-1.9,28.4,8.1
                C311.7,408.1,326.4,434.9,333.5,469.6z" />
                <path class="st3" d="M282.5,398.4c10.1-5.6,22.8-1.9,28.4,8.1c0.7,1.3,10.3,18.8,17.7,43.7c-11.8,7.3-24.8,13-38.8,16.5
                c-6.2-22.7-15.4-39.6-15.6-39.9C268.7,416.7,272.4,404,282.5,398.4z" />
                <ellipse class="st2" cx="256" cy="343" rx="107.7" ry="102.1" />
                <g>
                    <path class="st4" d="M441.1,323.6c-8.8-1.7-17.7-2.5-26.4-2.6L399.3,343l17.9,19.9c5.4,0.2,10.8,0.8,16.1,1.8
                    c11.3,2.2,22.3-5.3,24.5-16.6C459.9,336.7,452.4,325.8,441.1,323.6z" />
                    <path class="st4" d="M70.9,323.6c8.8-1.7,17.7-2.5,26.4-2.6l15.4,22.1l-17.9,19.9c-5.4,0.2-10.8,0.8-16.1,1.8
                    c-11.3,2.2-22.3-5.3-24.5-16.6C52.1,336.7,59.6,325.8,70.9,323.6z" />
                </g>
                <g>
                    <path class="st2" d="M417.2,362.9c-35.6-1.6-70.8,11.4-71.2,11.6c-2.4,0.9-4.9,1.4-7.4,1.4c-8.4,0-16.4-5.1-19.6-13.5
                    c-4.1-10.8,1.3-22.8,12.1-27c1.9-0.7,40.6-15.2,83.5-14.4C416.6,331,418.2,345.1,417.2,362.9z" />
                    <path class="st2" d="M94.8,362.9c35.6-1.6,70.8,11.4,71.2,11.6c2.4,0.9,4.9,1.4,7.4,1.4c8.4,0,16.4-5.1,19.6-13.5
                    c4.1-10.8-1.3-22.8-12.1-27c-1.9-0.7-40.6-15.2-83.5-14.4C95.4,331,93.8,345.1,94.8,362.9z" />
                </g>
                <g class="st3">
                    <path d="M41.8,43.2c-3.7,18.4,3,38.2,18.8,50.4s36.7,13.7,53.5,5.5c3.7-18.4-3-38.2-18.8-50.4S58.7,35,41.8,43.2z" />
                </g>
                <path class="st1" d="M24.5,117c11.5,14.9,30.7,22.8,50.4,18.9s34.4-18.7,39.3-36.8c-11.5-14.9-30.7-22.8-50.4-18.9
                C44.1,84.1,29.3,98.8,24.5,117z" />
                <circle class="st2" cx="428.5" cy="193.4" r="66.9" />
                <circle class="st2" cx="83.5" cy="193.4" r="66.9" />
                <g class="st3">
                    <circle cx="428.5" cy="193.4" r="66.9" />
                    <circle cx="83.5" cy="193.4" r="66.9" />
                </g>
                <circle class="st4" cx="428.5" cy="193.4" r="33.5" />
                <g>
                    <circle class="st4" cx="83.5" cy="193.4" r="33.5" />
                    <path class="st4" d="M256,414.1c-41.2,0-74.8-31-74.8-69s33.5-69,74.8-69s74.8,31,74.8,69S297.2,414.1,256,414.1z" />
                </g>
                <g>
                    <path class="st3" d="M192.9,362.3c4.1-10.8-1.3-22.8-12.1-27c-1.6-0.6-29.3-11-63.6-13.7c-4.7,13.5-7.9,27.9-10.1,41.3
                    c31,1.3,58.4,11.5,58.8,11.6c2.4,0.9,4.9,1.4,7.4,1.4C181.8,375.8,189.8,370.6,192.9,362.3z" />
                    <path class="st3" d="M319.1,362.3c-4.1-10.8,1.3-22.8,12.1-27c1.6-0.6,29.3-11,63.6-13.7c4.7,13.5,7.9,27.9,10.1,41.3
                    c-31,1.3-58.4,11.5-58.8,11.6c-2.4,0.9-4.9,1.4-7.4,1.4C330.2,375.8,322.2,370.6,319.1,362.3z" />
                </g>
                <path class="st3" d="M256,276.1c-41.2,0-74.8,31-74.8,69c0,6.1,0.9,12,2.5,17.6c22.5,8.6,46.8,13.3,72.3,13.3s49.8-4.7,72.3-13.3
                c1.6-5.6,2.5-11.5,2.5-17.6C330.8,307,297.2,276.1,256,276.1z" />
                <path class="st1" d="M96.4,106.9C122.2,44.1,184,0,256,0s133.8,44.1,159.6,106.9H96.4z" />
                <g>
                    <path class="st1" d="M223.7,342c0,0-5.3,51.7-4.3,74.7h-91c0,0,0-70.3,22.6-107.2L223.7,342z" />
                    <path class="st1" d="M288.3,342c0,0,5.3,51.7,4.3,74.7h91c0,0,0-70.3-22.6-107.2L288.3,342z" />
                </g>
                <g class="st3">
                    <path d="M360.9,309.5L288.3,342c0,0,1.5,14.1,2.7,30.9c30.2-5.3,58.1-17.2,82.1-34.2C370.1,328.1,366.1,317.9,360.9,309.5z" />
                    <path d="M138.8,338.8c24.1,17,52,28.9,82.1,34.2c1.2-16.8,2.7-30.9,2.7-30.9l-72.6-32.5C145.9,317.9,141.9,328.1,138.8,338.8z" />
                </g>
                <path class="st2" d="M428.5,172.5c0,95.3-77.2,172.5-172.5,172.5S83.5,267.8,83.5,172.5c0-23.2,4.6-45.4,12.9-65.7
                c0,0,50.8-31.6,159.6-31.6s159.6,31.6,159.6,31.6C423.9,127.1,428.5,149.3,428.5,172.5z" />
                <path class="st4" d="M271.6,129.1c-9.8,5-21.5,5-31.2,0c-56.7-29.3-135.3-5.7-111,86.6C156.1,316.8,256,312,256,312
                s99.9,4.8,126.6-96.3C406.9,123.4,328.4,99.8,271.6,129.1z" />
                <g>
                    <path class="st0" d="M182.4,223.6c-4.3,0-7.7-3.5-7.7-7.7v-14.3c0-4.3,3.5-7.7,7.7-7.7s7.7,3.5,7.7,7.7v14.3
                    C190.1,220.2,186.7,223.6,182.4,223.6z" />
                    <path class="st0" d="M329.6,223.6c-4.3,0-7.7-3.5-7.7-7.7v-14.3c0-4.3,3.5-7.7,7.7-7.7s7.7,3.5,7.7,7.7v14.3
                    C337.3,220.2,333.9,223.6,329.6,223.6z" />
                    <path class="st0" d="M281.4,225.1c-3.2-2.8-8.1-2.5-10.9,0.7c-1,1.2-2.6,1.9-4.3,1.9c-1.7,0-3.3-0.7-4.3-1.9
                    c-1.4-1.7-3.6-2.6-5.8-2.6c-2.2,0-4.4,1-5.8,2.6c-1,1.2-2.6,1.9-4.3,1.9s-3.3-0.7-4.3-1.9c-2.8-3.2-7.7-3.5-10.9-0.7
                    c-3.2,2.8-3.5,7.7-0.7,10.9c4,4.5,9.8,7.1,16,7.1c3.6,0,7.1-0.9,10.2-2.5c3.1,1.6,6.5,2.5,10.2,2.5c6.2,0,12-2.6,16-7.1
                    C284.9,232.8,284.6,227.9,281.4,225.1z" />
                </g>
            </svg>
            <style>#monkey {width: 20rem;}</style>
        </div>
    </section>

    <script>
        const sizeSelector = document.querySelector('#monkey-size')
        const hairSelector = document.querySelector('#color-hair')
        const skinSelector = document.querySelector('#color-skin')
        const clothesSelector = document.querySelector('#color-clothes')
        const bootSelector = document.querySelector('#color-boots')

        hairSelector.addEventListener('input', function() {
            document.querySelectorAll('.st2').forEach(tag => {
                tag.style.fill = this.value
            })
        })

        skinSelector.addEventListener('input', function() {
            document.querySelectorAll('.st4').forEach(tag => {
                tag.style.fill = this.value
            })
        })

        clothesSelector.addEventListener('input', function() {
            document.querySelectorAll('.st1').forEach(tag => {
                tag.style.fill = this.value
            })
        })

        bootSelector.addEventListener('input', function() {
            document.querySelectorAll('#boots .st0').forEach(tag => {
                tag.style.fill = this.value
            })
        })

        document.querySelector('#form-1').addEventListener('reset', function() {
            setTimeout(function() {
                document.querySelectorAll('#boots .st0').forEach(tag => {tag.style.fill = '#3A484A'})
                document.querySelectorAll('.st1').forEach(tag => {tag.style.fill = '#F2C42C'})
                document.querySelectorAll('.st2').forEach(tag => {tag.style.fill = '#C86D5C'})
                document.querySelectorAll('.st4').forEach(tag => {tag.style.fill = '#FBC4AC'})
            }, 250)
        })
    </script>
</body>
</html>