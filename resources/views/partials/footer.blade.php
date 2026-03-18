<footer class="footer">
    <div class="footer-main">
        <div class="footer-content">
            <div class="footer-logo-section">
                <a href="{{ route('home') }}" class="footer-logo">
                    @if(Storage::exists('public/logo-footer.png'))
                        <img src="{{ asset('storage/logo-footer.png') }}" alt="Vantix Stay">
                    @else
                        <span>Vantix Stay</span>
                    @endif
                </a>
                <p class="footer-tagline">Apartment modern dan nyaman untuk pengalaman menginap terbaik</p>
                
                <div class="social-icons">
                    <a href="{{ setting('instagram', '#') }}" class="social-icon" target="_blank">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                            <path d="M30.625 4.375H11.375C7.60761 4.375 4.375 7.60761 4.375 11.375V30.625C4.375 34.3924 7.60761 37.625 11.375 37.625H30.625C34.3924 37.625 37.625 34.3924 37.625 30.625V11.375C37.625 7.60761 34.3924 4.375 30.625 4.375Z" stroke="#EFEFEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M28.875 19.9325C29.1044 21.4045 28.8952 22.9106 28.2797 24.2608C27.6643 25.611 26.6747 26.7356 25.4356 27.4899C24.1966 28.2442 22.7684 28.5895 21.3296 28.4788C19.8907 28.3681 18.5299 27.8069 17.4142 26.8743C16.2985 25.9417 15.4864 24.6867 15.091 23.2796C14.6956 21.8725 14.7376 20.3824 15.2119 19.0004C15.6862 17.6183 16.5679 16.4129 17.7352 15.546C18.9025 14.6791 20.2958 14.1971 21.74 14.165" stroke="#EFEFEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M30.1875 11.8125H30.2046" stroke="#EFEFEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    
                    <a href="{{ setting('facebook', '#') }}" class="social-icon" target="_blank">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                            <path d="M24.5 23.625H28.875L31.5 16.625H24.5V13.125C24.5 11.3375 24.5 8.75 31.5 8.75H28.875V4.375C26.4958 4.08375 24.0944 4.14875 21.735 4.5675C18.5512 5.125 16.625 7.4375 16.625 11.1125V16.625H10.5V23.625H16.625V37.625H24.5V23.625Z" fill="#EFEFEF"/>
                        </svg>
                    </a>
                    
                    <a href="{{ setting('whatsapp', '#') }}" class="social-icon" target="_blank">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                            <path d="M35.4375 6.5625C31.7951 2.94744 27.0444 0.680293 21.9725 0.180356C16.9005 -0.319582 11.8254 0.981455 7.59463 3.8545C3.36386 6.72754 0.24677 10.9838 -0.344257 15.9213C-0.935283 20.8588 1.06443 25.8286 4.655 29.4425L3.5 38.5L12.95 35.875C16.225 37.5407 19.8703 38.3805 23.555 38.325C29.025 38.325 34.125 36.05 37.8875 32.2875C40.7352 29.4512 42.5231 25.7144 42.5231 21.7875C42.5231 17.8606 40.7352 14.1238 37.8875 11.2875L35.4375 6.5625Z" stroke="#EFEFEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15.75 17.5C15.75 19.225 16.8 21.9625 18.8125 23.975C20.825 25.9875 23.5625 27.0375 25.2875 27.0375" stroke="#EFEFEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    
                    <a href="{{ setting('twitter', '#') }}" class="social-icon" target="_blank">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none">
                            <path d="M39.8125 7.9625C38.3592 9.01042 36.7383 9.80042 35.0175 10.2987C34.1008 9.18407 32.8769 8.37335 31.5048 7.96825C30.1327 7.56314 28.6741 7.58361 27.3125 8.02699C25.9508 8.47036 24.7473 9.31485 23.8595 10.4541C22.9717 11.5934 22.4427 12.9737 22.34 14.4237C22.2838 15.1521 22.3426 15.8849 22.5132 16.5932C19.1559 16.4284 15.8927 15.5027 12.9875 13.8987C10.0824 12.2948 7.6223 10.0621 5.8125 7.39375C5.8125 7.39375 0.4375 19.6875 14.4375 25.8125C11.4792 27.8938 7.9625 29.3125 4.375 29.3125C18.375 37.1875 35.4375 29.3125 35.4375 14.35C35.435 13.9502 35.3943 13.5514 35.3159 13.1594C37.1452 11.3641 38.4385 9.1085 39.0625 6.65L39.8125 7.9625Z" stroke="#EFEFEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="footer-links">
                <div class="link-column">
                    <h4 class="link-header">Company</h4>
                    <a href="{{ route('home') }}" class="link-item">Home</a>
                    <a href="{{ route('property') }}" class="link-item">Property</a>
                    <a href="{{ route('about') }}" class="link-item">About</a>
                    <a href="{{ route('contact') }}" class="link-item">Contact</a>
                </div>
                
                <div class="link-column">
                    <h4 class="link-header">Support</h4>
                    <a href="#" class="link-item">Help center</a>
                    <a href="#" class="link-item">Tweet</a>
                    <a href="#" class="link-item">Feedback</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="copyright">
        <div class="copyright-icon"></div>
        <span class="copyright-text">Copyright {{ date('Y') }} by Vantix Stay. All Rights Reserved.</span>
    </div>
</footer>