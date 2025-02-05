<footer class="container-fluid bg-dark text-light footer pt-3 wow fadeInUp" id="footer">
        <div class="container py-3">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h4 class="pacifico text-start text-warning mt-4">Restaurant</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="pacifico text-start text-warning mt-4">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Kobayat, Akkar, Lebanon</p>
                    <p class="mb-2"><i class="fa fa-phone me-3"></i><?php echo htmlspecialchars(strval($phoneNumber), ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i><?php echo htmlspecialchars(strval($email), ENT_QUOTES, 'UTF-8'); ?></p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" target="_blank" href="<?php echo htmlspecialchars(strval($facebook), ENT_QUOTES, 'UTF-8');; ?>"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" target="_blank" href="<?php echo htmlspecialchars(strval($instagram), ENT_QUOTES, 'UTF-8');; ?>"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="pacifico text-start text-warning mt-4">Opening</h4>
                    <h5 class="text-light fw-normal">Wednesday - Monday</h5>
                    <p>09AM - 11PM</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="pacifico text-start text-warning mt-4">Feedback</h4>
                    <p>Inform us about your dining experience and inspire us with your recommendations !</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-warning w-100 py-3 ps-4 pe-5" type="text" placeholder="Your feedback">
                        <button type="button" class="btn btn-warning py-2 position-absolute top-0 end-0 mt-2 me-2"><span class="text-center text-white">Submit</span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Daddy's Restaurant</a><span> | All Right Reserved.
                </div>
            </div>
        </div>
    </footer>