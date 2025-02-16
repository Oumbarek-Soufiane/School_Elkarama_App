<footer class="footer">
    <div class="div-footer" style="display: flex;">
        <div class="map" width="400" height="300">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3243.3877542867244!2d-5.277499224931943!3d35.61816627260764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0b44d173337dd5%3A0xffb4711fe29a3692!2sEcole%20Normale%20Sup%C3%A9rieure%20T%C3%A9touan!5e0!3m2!1sfr!2sma!4v1701451340189!5m2!1sfr!2sma"
                style="border:0;width: 100%; height: 300px; " allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <div class="container_contact_us_logo" style="margin-left: auto;margin-top: -30px" width="400" height="300">
            <a class="nav-link" style="position: relative;" href="#">
                <img class="logo" style="z-index: -2;" width="300px" src="{{ asset('img/logo.png') }}" alt="image" /><br>
            </a>

            <div class="contact_us" style="margin-top: ;margin-left:30px;">
                <form action="">
                    <input type="text" class="form-control" style="width: 280px; z-index: 8;" placeholder="Your Name"><br>
                    <div class="input-group mb-3" style="width: 280px" >
                        <span class="input-group-text" id="basic-addon1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-filled"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M22 7.535v9.465a3 3 0 0 1 -2.824 2.995l-.176 .005h-14a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-9.465l9.445 6.297l.116 .066a1 1 0 0 0 .878 0l.116 -.066l9.445 -6.297z"
                                    stroke-width="0" fill="currentColor" />
                                <path
                                    d="M19 4c1.08 0 2.027 .57 2.555 1.427l-9.555 6.37l-9.555 -6.37a2.999 2.999 0 0 1 2.354 -1.42l.201 -.007h14z"
                                    stroke-width="0" fill="currentColor" />
                            </svg>
                        </span>
                        <input type="text" class="form-control" placeholder="Email" aria-label="Email"
                            aria-describedby="basic-addon1">
                    </div>
                    <textarea class="form-control" style="width: 280px"  rows="3" placeholder="Your Message ..."></textarea>
                    <br><button class="button1 mt-2" type="submit">Submit</button><br><br>
                </form>
            </div>
        </div>
    </div>
    <div>
        <p class="text-center copyright">Academic Institution Management .&copy;Copyright 2023. All rights reserved.</p>
    </div>

</footer>
