<?php defined('BASEPATH') or exit('No direct script access allowed');

$this->load->view('frontend/includes/header');

?>

<style>
    .thead-dark {
        background: #006c16 !important;
        font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif' !important;
        color: #fff;
        font-weight: 400 !important;
        font-size: 14px !important;
    }

    .form-control {
        webkit-box-shadow: none !important;
        box-shadow: none !important;
        border-radius: 0;
        height: 38px !mportant;
        margin-top: 21px !mportant;
    }
</style>

<section class="form-contact-text">

    <div class="container">

        <div class="row">


            <br>

            <!--+++++++++++++++++++++++right-side==============-->

            <div class="col-sm-12 white-gap">
                <br clear="all">

                <div style=" width: 100%; display: block; clear: both; height: 6px; border-top: 1px solid #76b382; border-bottom: 1px solid #76b382; margin-top: 10px;"></div>
                <br clear="all">
                <div class="row">

                    <div class="col-sm-4">
                        <!--++++++++++image+++++-->
                        <img src="http://182.75.124.211/royal-serry-dev/uploads/news_image/<?php echo (!empty($newsData))?$newsData['image']:''; ?>" alt="" width="100%">
                        <!--+++++++++++++++++++++++++dashboard================-->

                    </div>
                    <div class="col-sm-8">
                        <h3><?php echo (!empty($newsData))?$newsData['name']:''; ?></h3>

                        <p><?php echo (!empty($newsData))?$newsData['description']:''; ?></p>

                    </div>



                </div>



                <div class="container-fluid">

                    <div class="row justify-content-center">

                        <div class="card">



                            <br clear="all">

                            <div style=" width: 100%; display: block; clear: both; height: 6px; border-top: 1px solid #76b382; border-bottom: 1px solid #76b382; margin-top: 10px;"></div>
                            <br clear="all">


                            <div class="table-responsive-sm">

                            </div>
                        </div>

                    </div>

                </div>

                <!--+++++++++++++++++++++++dashboard-end++++++++++++-->

            </div>

            <!--+++++++++++++++++++++++right-side==============-->

        </div>

    </div>

</section>

<?php $this->load->view('frontend/includes/footer'); ?>