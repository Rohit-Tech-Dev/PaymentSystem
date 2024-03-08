<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPI Payment</title>
    <meta name="theme-color" content="#673AB6">

    <link href="{{ asset('payGN/css/option19.css') }}" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>

<body>
    <section class="gradientpay-wrapper">
        <div class="gradientpay-card">
            <div class="newgradient-part" style="background-image: url('/payGN/images/option19/topbg-frame.png');">
                <div class="newgradient-ct">
                    <h4>Complete Your UPI Payment</h4>
                    <div class="gradrupees progress">
                        <div class="progress_inner">
                            <div class="progress-value"></div>
                            <span class="progress_text">Pending</span>
                        </div>
                    </div>
                    <div class="success-btn">
                        <button class="success-payment">SUCESSFUL</button>
                        <span class="success-rupees"><img src="{{ asset('payGN/images/option19/check.png') }}"
                                alt="rupee"></span>
                    </div>
                </div>
                <div class="newgradient-img">
                    <img src="{{ asset('payGN/images/option19/plane-mobile.gif') }}" alt="plane-mobile">
                </div>
            </div>
            <div class="newgradient-choose">
                <h4>Choose a UPI to make the payment</h4>
                <div class="app__bg_wrpr">
                    <div class="apps-bg">
                        <ul>
                            <li>
                                <a href="{{ str_replace('upi://', 'gpay://upi/', $params['paymentUrl']) }}"
                                    id="btn-upi-intent">
                                    <div class="gradientapp-img">
                                        <img src="{{ asset('payGN/images/option19/appsbg-gpay.png') }}" alt="gpay">
                                    </div>
                                    <p>Gpay</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ str_replace('upi://', 'phonepe://', $params['paymentUrl']) }}"
                                    id="btn-upi-intent">
                                    <div class="gradientapp-img">
                                        <img src="{{ asset('payGN/images/option19/appsbg-phonepe.png') }}"
                                            alt="phonepe">
                                    </div>
                                    <p>Phonepe</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ str_replace('upi://', 'paytmmp://', $params['paymentUrl']) }}"
                                    id="btn-upi-intent">
                                    <div class="gradientapp-img">
                                        <img src="{{ asset('payGN/images/option19/appsbg-paytm.png') }}" alt="paytm">
                                    </div>
                                    <p>Paytm</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ str_replace('upi://', 'upi://', $params['paymentUrl']) }}"
                                    id="btn-upi-intent">
                                    <div class="gradientapp-img">
                                        <img src="{{ asset('payGN/images/option19/appsbg-more.png') }}"
                                            alt="view-more">
                                    </div>
                                    <p>More</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="gradmiddle-or">
                <p>OR</p>
            </div>
            <div class="gradient-qrwrapper">
                <div class="gradtimer-wrap">
                    <div class="gradientqr-scan">
                        <div class="gradrupee-scan">
                            <img style="display:none" src="" alt="qrcode" id="myImg">
                        </div>

                    </div>
                    <div class="newgradient-timer">
                        <h4 style="text-align:center !important">Scan the QR code on any UPI app to make the payment
                        </h4>
                        <div class="roundframe">
                            <img src="{{ asset('payGN/images/option19/round-timer.gif') }}" alt="round-timer">
                            <div id="roundframe-timer" class="roundtime">
                                0:23
                                <span class="new-time-left">Time left</span>
                            </div>
                        </div>
                        <!-- <a href="/json_video" target="_blank"  class="gradient_download_btn" download="">
                     <span><img src="{{ asset('payGN/images/option19/down-icon.png') }}" alt="download"></span>
                     <span>Download QR code</span>
                     </a> -->
                    </div>
                </div>
                <div class="grad-end-content">
                    <h4>After making the payment of INR {{ $params['payment']->total }}, Please click on the
                        <span>continue</span> button, if not automatically redirected.
                    </h4>
                </div>
                <a href="javascript:void(0);" type="button" id="gradcontinuepopup"
                    class="gradientcontinue-btn">Continue</a>
            </div>
        </div>
    </section>
    <!-- continue Modal here-->
    <div id="newgradModal" class="newgradientmodal">
        <!-- Modal content -->
        <div class="newgradmodal-content">
            <p>We are yet to receive your payment, we will credit it as soon as we receive it. You can wait on this
                screen or close and continue playing and your payment will be auto-credited.
            </p>
            <div class="complete-timer newgradmodal-timer">
                <p id="newgradmodal-clock">05:34 </p>
            </div>
            <div class="completemodal-controls">
                <button class="completeclose greenclose">Close</button>
                <button class="completewait newgradientwait">Wait</button>
            </div>
        </div>
    </div>
    <!-- continue modal ends here -->
    <!-- image popup Modal starts here -->
    <div id="scanModal" class="newqrscanmodal">
        <!-- Modal Content (The Image) -->
        <div class="qrmodal__img">
            <p
                style="color: #fff;
                      font-size: 14px;
                      text-align: center;
                      padding: 0 15px;">
                Scan the QR code on any UPI app to make the payment
            </p>
            <img class="qrmodal-content" id="img01" src="" alt="Qrcode">
        </div>
    </div>
    <!-- image popup Modal ends here -->
    <script>
        var clicked = 0;

        setTimeout(() => {
            document.querySelector('.gradientpay-wrapper').classList.add('success');
        }, 2000);
        //countdown timer js
        function countdown(elementName, minutes, seconds) {
            var element, endTime, hours, mins, msLeft, time;

            function twoDigits(n) {
                return (n <= 9 ? "0" + n : n);
            }

            function updateTimer() {
                msLeft = endTime - (+new Date);
                console.log(msLeft);
                if (msLeft < 1000) {
                    element.innerHTML = "00:00";
                } else {
                    time = new Date(msLeft);
                    hours = time.getUTCHours();
                    mins = time.getUTCMinutes();
                    element.innerHTML = (hours ? hours + ':' + twoDigits(mins) : mins) + ':' + twoDigits(time
                        .getUTCSeconds());
                    setTimeout(updateTimer, time.getUTCMilliseconds() + 500);
                }
            }
            element = document.getElementById(elementName);
            endTime = (+new Date) + 1000 * (60 * minutes + seconds) + 500;
            updateTimer();
        }
        countdown("roundframe-timer", 10, 0);
        countdown("newgradmodal-clock", 10, 0);

        // Get the modal
        var modal = document.getElementById("scanModal");
        // Get the image and insert it inside the modal - use its "alt" text as a caption
        // var img = document.getElementById("myImg");
        // var modalImg = document.getElementById("img01");
        // img.addEventListener('click', function() {
        //     modal.style.display = "flex";
        //  setTimeout(function(){Incimg()}, 3000);
        //});

        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        img.onclick = function() {
            modal.style.display = "flex";
        }

        const newqrscanmodal = document.querySelector('.newqrscanmodal')

        window.addEventListener('click', (e) => {
            console.log(e.target.classList.contains('newqrscanmodal'))

            e.target.classList.contains('newqrscanmodal') ? newqrscanmodal.style.display = 'none' : '';
        })


        //continue modal popup starts here
        var payprocess_progress = document.getElementById("newgradientmodal");

        // Get the modal
        var newgradientmodal = document.getElementById("newgradModal");

        // Get the button that opens the modal
        var btn = document.getElementById("gradcontinuepopup");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("completeclose")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            checkStatus();
            clicked = 1
            $('#gradcontinuepopup').html('Please wait...');
            setTimeout(function() {
                $('#gradcontinuepopup').html('Continue');
            }, 2000)

            newgradientmodal.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            newgradientmodal.style.display = "none";
            window.close();
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == newgradientmodal) {
                newgradientmodal.style.display = "none";
            }
        }

        $('.completewait').click(function() {
            $('#newgradModal').hide()
        })
    </script>
    <script type="text/javascript">
        const baseURL = 'https://api.qrserver.com/v1/create-qr-code/?data='
        const config = '&size=200x200'
        const qrCode = document.querySelector('#myImg')

        window.onload = () => {
            var src = baseURL + "{{ urlencode($params['paymentUrl']) }}"
            qrCode.src = src + config
            $('#img01').attr('src', src + '&size=200x200')
            $('#myImg').show();
        }

        function checkStatus() {
            $.ajax({
                type: 'POST',
                async: false,
                global: true,
                url: "/pg/fhl/hc/checkStatus/{{ $params['payment']->id }}",
                success: function(data) {

                    if (data.txnStatus == 4) {
                        window.location = '/pi/payment/success?orderId={{ $params['payment']->pi_order_id }}'
                    } else if (data.txnStatus == 2) {
                        window.location = '/pi/payment/failed?orderId={{ $params['payment']->pi_order_id }}'
                    }

                    if (clicked == 1) {
                        clicked = 0
                        $('.gradcontinuepopup').addClass("d_grid");
                    }

                    $('#continue-text').html('Continue');

                }
            });
        }

        setInterval(function() {
            checkStatus();
        }, 3000)
    </script>

    <script>
        window.history.pushState(null, null, '/')
    </script>
</body>

</html>
