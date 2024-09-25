<!-- PHP INCLUDES -->

<?php

    include "connect.php";
    include 'Includes/functions/functions.php';
    include "Includes/templates/header.php";
    include "Includes/templates/navbar.php";


    //Getting website settings

    $stmt_web_settings = $con->prepare("SELECT * FROM website_settings");
    $stmt_web_settings->execute();
    $web_settings = $stmt_web_settings->fetchAll();

    $restaurant_name = "";
    $restaurant_email = "";
    $restaurant_address = "";
    $restaurant_phonenumber = "";

    foreach ($web_settings as $option)
    {
        if($option['option_name'] == 'restaurant_name')
        {
            $restaurant_name = $option['option_value'];
        }

        elseif($option['option_name'] == 'restaurant_email')
        {
            $restaurant_email = $option['option_value'];
        }

        elseif($option['option_name'] == 'restaurant_phonenumber')
        {
            $restaurant_phonenumber = $option['option_value'];
        }
        elseif($option['option_name'] == 'restaurant_address')
        {
            $restaurant_address = $option['option_value'];
        }
    }

?>

	<!-- HOME SECTION -->
	<section class="home-section" id="home">
		<div class="container">
			<div class="row" style="flex-wrap: nowrap;">
				<div class="col-md-6 home-left-section">
					<div style="padding: 100px 0px; color: white;">
						<h1>
							Las Tapas
						</h1>
						<h2>
							MAKING PEOPLE HAPPY
						</h2>
						<hr>
						<p>
							Tapas 
						</p>
						<div style="display: flex;">
							<a href="order_food.php" target="_blank" class="bttn_style_1" style="margin-right: 10px; display: flex;justify-content: center;align-items: center;">
								Order Now
								<i class="fas fa-angle-right"></i>
							</a>
							<a href="#menus" class="bttn_style_2" style="display: flex;justify-content: center;align-items: center;">
								VIEW MENU
								<i class="fas fa-angle-right"></i>
							</a>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>

	<!-- OUR QUALITIES SECTION -->

	<section class="our_qualities" style="padding:100px 0px;">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/images/quality_food_img.png" >
	                    <div class="caption">
	                        <h3>
	                            Quality Foods
	                        </h3>
	                        <p>
	                        	We have the best food
	                        </p>
	                    </div>
	                </div>
				</div>
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/images/fast_delivery_img.png" >
	                    <div class="caption">
	                        <h3>
	                            Quality Foods
	                        </h3>
	                        <p>
	                        	We have the best food
	                        </p>
	                    </div>
	                </div>
				</div>
				<div class="col-md-4">
					<div class="our_qualities_column">
	                    <img src="Design/images/original_taste_img.png" >
	                    <div class="caption">
	                        <h3>
	                            Quality Foods
	                        </h3>
	                        <p>
	                        	We have the best food
	                        </p>
	                    </div>
	                </div>
				</div>

			</div>
		</div>
	</section>

	<!-- IMAGE GALLERY -->

	<section class="image-gallery" id="gallery">
		<div class="container">
			<h2 style="text-align: center;margin-bottom: 30px">IMAGE GALLERY</h2>
			<?php
				$stmt_image_gallery = $con->prepare("Select * from image_gallery");
                $stmt_image_gallery->execute();
                $rows_image_gallery = $stmt_image_gallery->fetchAll();

                echo "<div class = 'row'>";

	                foreach($rows_image_gallery as $row_image_gallery)
	                {
	                	echo "<div class = 'col-md-4 col-lg-3' style = 'padding: 15px;'>";
	                		$source = "admin/Uploads/images/".$row_image_gallery['image'];
	                		?>

	                		<div style = "background-image: url('<?php echo $source; ?>') !important;background-repeat: no-repeat;background-position: 50% 50%;background-size: cover;background-clip: border-box;box-sizing: border-box;overflow: hidden;height: 230px;">
	                		</div>

	                		<?php
	                	echo "</div>";
	                }

	            echo "</div>";
			?>
		</div>
	</section>

	<!-- CONTACT US SECTION -->

	<section class="contact-section" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 sm-padding">
                    <div class="contact-info">
                        <h2>
                            Get in touch with us & 
                            <br>send us message today!
                        </h2>
                        <h3>
                            <?php echo $restaurant_address; ?>
                        </h3>
                        <h4>
                            <span>Email:</span> 
                            <?php echo $restaurant_email; ?>
                            <br> 
                            <span>Phone:</span> 
                            <?php echo $restaurant_phonenumber; ?>
                        </h4>
                    </div>
                </div>
                <div class="col-lg-6 sm-padding">
                    <div class="contact-form">
                        <div id="contact_ajax_form" class="contactForm">
                            <div class="form-group colum-row row">
                                <div class="col-sm-6">
                                    <input type="text" id="contact_name" name="name" oninput="document.getElementById('invalid-name').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Name">
                                    <div class="invalid-feedback" id="invalid-name" style="display: block">
                                    	
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" id="contact_email" name="email" oninput="document.getElementById('invalid-email').innerHTML = ''" class="form-control" placeholder="Email">
                                    <div class="invalid-feedback" id="invalid-email" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" id="contact_subject" name="subject" oninput="document.getElementById('invalid-subject').innerHTML = ''" onkeyup="this.value=this.value.replace(/[^\sa-zA-Z]/g,'');" class="form-control" placeholder="Subject">
                                    <div class="invalid-feedback" id="invalid-subject" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="contact_message" name="message" oninput="document.getElementById('invalid-message').innerHTML = ''" cols="30" rows="5" class="form-control message" placeholder="Message"></textarea>
                                    <div class="invalid-feedback" id="invalid-message" style="display: block">
                                    	
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button id="contact_send" class="bttn_style_2">Send Message</button>
                                </div>
                            </div>
                            <div id="sending_load" style="display: none;">Sending...</div>
                            <div id="contact_status_message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<!-- OUR QUALITIES SECTION -->
	
	<section class="our_qualities_v2">
		<div class="container">
			<div class="row">
				<div class="col-md-4" style="padding: 10px;">
					<div class="quality quality_1">
						<div class="text_inside_quality">
							<h5>Quality Foods</h5>
						</div>
					</div>
				</div>
				<div class="col-md-4" style="padding: 10px;">
					<div class="quality quality_2">
						<div class="text_inside_quality">
							<h5>Fastest Delivery</h5>
						</div>
					</div>
				</div>
				<div class="col-md-4" style="padding: 10px;">
					<div class="quality quality_3">
						<div class="text_inside_quality">
							<h5>Original Recipes</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- WIDGET SECTION / FOOTER -->

    <section class="widget_section" style="background-color: #222227;padding: 100px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <img src="Design/images/restaurant-logo.png" alt="Restaurant Logo" style="width: 150px;margin-bottom: 20px;">
                        <p>
                            Our Restaurnt is one of the bests, provide tasty Menus and Dishes. You can reserve a table or Order food.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                     <div class="footer_widget">
                        <h3>Headquarters</h3>
                        <p>
                            <?php echo $restaurant_address; ?>
                        </p>
                        <p>
                            <?php echo $restaurant_email; ?>
                            <br>
                            <?php echo $restaurant_phonenumber; ?>   
                        </p>
                     </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer_widget">
                        <h3>
                            Opening Hours
                        </h3>
                        <ul class="opening_time">
                            <li>Monday - Friday 11:30am - 12:00pm</li>
                            <li>Monday - Friday 11:30am - 12:00pm</li>
                            <li>Monday - Friday 11:30am - 12:00pm</li>
                            <li>Monday - Friday 11:30am - 12:00pm</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
