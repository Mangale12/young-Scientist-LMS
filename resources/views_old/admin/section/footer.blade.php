<footer class="site-footer">
  <div class="text-center" style="font-weight: bold;">
  {{ getUnicodeNumber(date('Y')) }}&copy; किसान सूचीकरण तथा व्यवस्थापन प्रणाली. पृष्ठ लोडहुन लाग्ने समय {{ getUnicodeNumber(round((microtime(true) - LARAVEL_START),2) ) }} सेकेन्ड  ।@if(isset(Auth::user()->last_login_at)) Your IP Address is {{ Auth::user()->last_login_ip }}<strong></strong>@endif
    <a href="#" class="go-top">
      <i class="fa fa-angle-up"></i>
    </a>
  </div>
</footer>