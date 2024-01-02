<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="<?php echo e(asset('css/fonts.css')); ?>" rel="stylesheet"  type='text/css'>
    <script src="https://kit.fontawesome.com/8110324a96.js" crossorigin="anonymous"></script>
    <title>Merchies</title>
</head>
<body>
<h3 style="text-align: center;">Merchie Control Page</h3>
<div class="container" >

    <div class="row">
        <div class="col">
            <a href='<?php echo url("/merchieOrders"); ?>' onclick="window.open(this.href, 'merchieOrders',
'left=20,top=20,width=1250,height=1250,toolbar=1,resizable=0'); return false;" style="color: black" target="_blank"> <i class="fas fa-file-invoice-dollar fa-9x" style="color: #bb1523"></i>
                <br>
            <h4>Orders</h4>
            </a>

        </div>
        <div class="col">
            <a href='<?php echo url("/merchieVisits"); ?>' onclick="window.open(this.href, 'merchieVisits',
'left=20,top=20,width=1250,height=1250,toolbar=1,resizable=0'); return false;" style="color: black" target="_blank"> <i class="fas fa-map-marker fa-9x" style="color: #bb1523"></i>
                <br>
                <h4> Visits</h4>
            </a>
        </div>
</div>
    <div class="row">
        <div class="col">
            <a href='<?php echo url("/merchieStocktakes"); ?>' onclick="window.open(this.href, 'merchieStocktakes',
'left=20,top=20,width=1250,height=1250,toolbar=1,resizable=0'); return false;" style="color: black" target="_blank"> <i class="fas fa-boxes fa-9x" style="color: #bb1523"></i>
                <br>
                <h4>Stock-Takes</h4>
            </a>
        </div>
        <div class="col">
            <a href='<?php echo url("/merchieUsers"); ?>' onclick="window.open(this.href, 'merchieUsers',
'left=20,top=20,width=1250,height=1250,toolbar=1,resizable=0'); return false;" style="color: black" target="_blank"> <i class="fas fa-users fa-9x" style="color: #bb1523"></i>
                <br>
                <h4>Users Panel</h4>
            </a>
        </div>
    </div>
	
	<div class="row">
        <div class="col">
            <a href='<?php echo url("/cutOffTimeGrid"); ?>' onclick="window.open(this.href, 'cutOffTimeGrid',
'left=20,top=20,width=1250,height=1250,toolbar=1,resizable=0'); return false;" style="color: black" target="_blank"> <i class="fas fa-clock fa-9x" style="color: #bb1523"></i>
                <br>
                <h4>Cut Off Time Grid</h4>
            </a>
        </div>
		<div class="col">
            <a href='<?php echo url("/getClockInOutGrid"); ?>' onclick="window.open(this.href, 'getClockInOutGrid',
'left=20,top=20,width=1250,height=1250,toolbar=1,resizable=0'); return false;" style="color: black" target="_blank"> <i class="fas fa-book fa-9x" style="color: #bb1523"></i>
                <br>
                <h4>Clock Ins and Outs</h4>
            </a>
        </div>
       
    </div>
	<div class="row">
        <div class="col">
            <a href='<?php echo url("/specials"); ?>' onclick="window.open(this.href, 'specials',
'left=20,top=20,width=1250,height=1250,toolbar=1,resizable=0'); return false;" style="color: black" target="_blank"> <i class="fas fa-star fa-9x" style="color: #bb1523"></i>
                <br>
                <h4>Specials</h4>
            </a>
        </div>

       
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
<?php /**PATH C:\wamp64\www\smdfmerchieadmin\dims21\resources\views/merchie/landing.blade.php ENDPATH**/ ?>