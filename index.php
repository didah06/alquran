<html>
<head>
    <title>Al-Qur'an</title>
    <!-- menghubungkan dengan file css -->
    <link rel="stylesheet" type="text/css" href="assets/css/stylee.css">
    <!-- menghubungkan dengan file jquery -->
    <script type="text/javascript" src="jquery.js"></script>
</head>
<body>
<!-- 
Author : diki alfarabi hadi 
Site : www.malasngoding.com
-->

<div class="content">
    
    <div class="menu">
        <ul>
            <li><a href="index.php?page=home">HOME</a></li>
            <li><a href="index.php?page=rukunislam">Rukun Islam</a></li>
            <li><a href="index.php?page=rukuniman">Rukun Iman</a></li>
            <li><a href="login.php">LOGIN</a></li>
        </ul>
    </div>

    

    <div class="badan">

    <?php 
    if(isset($_GET['page'])){
        $page = $_GET['page'];
 
        switch ($page) {
            case 'home':
                include "home.php";
                break;
            case 'rukunislam':
                include "halaman/rukunislam.php";
                break;
            case 'rukuniman':
                include "halaman/rukuniman.php";
                break;          
            default:
                echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                break;
        }
    }else{
        include "home.php";
    }
 
     ?>
 
    </div>
</div>
</body>
</html>