<?php $this->load->view("home/inc/header") ?>
<section id="content" class="single-wrapper">
    <div class="grey-background wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="container">
            <div class="heading-block page-title wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <h1>Contact</h1>
            </div>
        </div>
    </div>

    <div class="contact-section">
        <div class="container">
            <div class="row">

                <div class="contact-details col-md-4 wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                    <p>Feel free to call us directly or simply complete our form and we will follow up with you.</p>

                    <div class="visit-us">
                        <div class="contact-icon">
                            <span class="icon icon-pin-1"></span>
                        </div>
                        <div class="contact-content">
                            <h3>Visit us</h3>
							<p>6, Akinwale Street,</p>
							<p>Ogba, Ikeja,</p>
							<p>Lagos State, Nigeria.</p> 
                        </div>
                    </div>

                    <div class="contact-us">
                        <div class="contact-icon">
                            <span class="icon icon-hand-right"></span>
                        </div>
                        <div class="contact-content">
                            <h3>Contact us</h3>
							<p>08023148981 | 08033160691</p>
							<p><a href="mailto:info@lucidstars.sch.ng">info@lucidstars.sch.ng</a></p>
                        </div>
                    </div>
                </div>

                <div class="contact-form col-md-8 wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                    <form method="post">
                        <input type="text" name="name" id="name" placeholder="Name">
                        <input type="text" name="email" id="email" placeholder="Email">
                        <input type="text" name="subject" id="subject" placeholder="Subject">
                        <textarea name="message" id="message" cols="45" rows="5" placeholder="Message"></textarea>
                        <button class="submit button-normal green">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view("home/inc/footer") ?>