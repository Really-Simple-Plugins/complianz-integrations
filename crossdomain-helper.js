/* In multisite, sending consent to a different domain is called, cross-domain consent. This is in 99% cases not compliant, as the slightest difference in websites
 * will require the webmaster to ask consent for the difference. For the 1% the below is a client-side use case, but as cross-domain's future is uncertain for both security, browsers
 * and soforth, this is a helper to see if it might work.
 */

<script>
document.addEventListener('cmplz_status_change', function (e) {
    if (e.detail.category === 'statistics' && e.detail.value==='allow') {
        let secure = ";secure";
        let date = new Date();
        date.setTime(date.getTime() + (complianz.cookie_expiry * 24 * 60 * 60 * 1000));
        let expires = ";expires=" + date.toGMTString();

        if ( window.location.protocol !== "https:" ) secure = '';

        let domain = window.location.hostname;
        //if domain includes '.nl', add '.com' domain, and vice versa
        if (domain.indexOf('.nl') !== -1) {
            domain = domain.replace('.nl', '.com');
        } else {
            domain = domain.replace('.com', '.nl');
        }

        let prefix = complianz.prefix;
        document.cookie = prefix+name + "=" + value + ";SameSite=Lax" + secure + expires + domain + ";path="+cmplz_get_cookie_path();
    }
});
</script>
