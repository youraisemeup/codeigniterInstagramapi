        <div class="card">
            <div class="body account-pop-up custom-popup">
                <div class="row">
                    <div class="col-sm-12 mb0">
                        <h3><?=l('Account Connect Help')?></h3>
                        <a href="#" class="btn-close-x" data-dismiss="modal" aria-label="Close"></a>
                    </div>
                    <div class="col-sm-12 mb0">
                        <div class="mb20">
                            <p>Find the specific error you're receiving and learn how to fix it.</p>

                            <ul class="nice-list">
                                <li>
                                    <p><strong>Incorrect username</strong></p>
                                    <p>You have entered the incorrect Instagram username.</p>
                                    <p>
                                        Remember, do not enter your <?=config_item('app_name')?> login email here, but
                                        your Instagram username.
                                    </p>
                                    <p>Try looking up the username on Instagram to ensure it exists.</p>
                                </li>
                                <li>
                                    <p><strong>Incorrect password for &lt;username&gt;</strong></p>
                                    <p>You have entered the incorrect Instagram password.</p>
                                    <p>
                                        Please note:
                                    </p><ul>
                                        <li>This field is case sensitive;</li>
                                        <li>
                                            Some devices automatically make the first letter uppercase, even in
                                            the password field;
                                        </li>
                                        <li>
                                            Make sure you’re not accidentally copy and pasting a space or
                                            a line break.
                                        </li>
                                    </ul>
                                    <p></p>
                                    <p>Try logging in to Instagram to see if the password is correct.</p>
                                </li>
                                <li>
                                    <p><strong>Verify your account</strong> <span class="label label-warning-custom">New</span></p>
                                    <p>
                                        Instagram is trying to protect your account, so there’s no need to worry.
                                        You simply need to complete this verification step.
                                    </p>
                                    <p>
                                        Instagram will send you a security code to the email address or mobile
                                        phone number associated with your Instagram account (not your <?=config_item('app_name')?> email).
                                    </p>
                                    <p>
                                        You need to enter the code to complete the verification step. Please enter the
                                        code as soon as you receive it, as it will expire in a short period of time.
                                    </p>
                                </li>
                                <li>
                                    <p><strong>Verification loop</strong> <span class="label label-warning-custom">New</span></p>
                                    <p>
                                        If you tried to verify your account and were returned to the login stage again,
                                        you may be stuck in a verification loop from Instagram. Note: This is not
                                        an error from <?=config_item('app_name')?>.
                                    </p>
                                    <p>
                                        Here’s what you can do to try to resolve the issue:
                                    </p><ol>
                                        <li>First, use the Force Connection Reset option, and try to verify again;</li>
                                        <li>
                                            If you’re still returned to the login stage, try to reset your
                                            Instagram password.
                                        </li>
                                    </ol>
                                    <p></p>
                                    <p>
                                        If you’re still stuck in the loop after trying these fixes, please wait
                                        1-2 days before you try again.
                                    </p>
                                </li>
                                <li>
                                    <p><strong>Two-factor authentication</strong></p>
                                    <p>
                                        You have two-factor authentication enabled on your Instagram account.
                                        Instagram will send you a security code to the mobile phone number
                                        associated with your Instagram account. If you’ve forgotten your
                                        mobile number associated with your Instagram account, just check
                                        your settings on the Instagram app.
                                    </p>
                                    <p>
                                        You need to enter the code to complete the second authentication step.
                                        Please enter the code as soon as you receive it, as it will expire in
                                        a short period of time.
                                    </p>
                                </li>
                                <li>
                                    <p><strong>Other errors</strong></p>
                                    <p><b>Password reset</b></p>
                                    <p>
                                        Instagram may sometimes reset your password when you're trying to
                                        login on third-party websites.  Go to your email (associated with
                                        your Instagram account) and check your inbox/spam folders for a
                                        message from Instagram with a password reset link.
                                    </p>
                                    <p>
                                        Note: This link may expire after some time, so please use it as soon
                                        as possible. If the link is sent more than once, make sure you use
                                        the last link that was sent (and not the old one).
                                    </p>
                                    <p><b>Connection Error &amp; Request Failed</b></p>
                                    <p>
                                        The proxy used for your account is momentarily not working. Our
                                        system will automatically fix these errors, but it may take some time.
                                    </p>
                                    <p>
                                        Here’s what you can do:
                                    </p><ol>
                                        <li>Wait 1-2 hours for the proxy to repair on its own;</li>
                                        <li>Try the Force Connection Reset option.</li>
                                    </ol>
                                    <p></p>
                                    <p><b>Unexpected login error</b> <span class="label label-warning-custom">New</span></p>
                                    <p>
                                        This type of errors is a rare one, but sometimes you may see it for some
                                        accounts. If you face this error, then there are two possible issues:
                                    </p><ol>
                                        <li>It's Instagram temporarily down and you just need to repeat after a while;</li>
                                        <li>
                                            It's something wrong with the account itself and you need to try
                                            to login directly on Instagram website to find what is going on.
                                            In most cases it's Instagram requires some special sort of
                                            additional verification.
                                        </li>
                                    </ol>
                                    <p></p>
                                </li>
                            </ul>

                            <p>
                                Please
<!--                                <a href="javascript:void(0);" class="alert-link dotted-underline">contact&nbsp;us</a>-->
                                <a href="mailto:support@igplan.com" class="alert-link dotted-underline">contact&nbsp;us</a>
                                if any of these errors persists for more than 24 hours.
                            </p>
                        </div>
                        <div class="text-align-center">
                            <button data-dismiss="modal" aria-label="Close" class="btn btn-dashboard bg-dashboard-default rounded-corner text-transform-none m-t-5">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
