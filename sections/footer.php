<!-- footer section -->
<section class="footer_section" style="background-color: #00204a;">
  <div class="container">
    <p style="color: #fff;">
      Copyright &copy; <a href="https://wasd.netmedia-framecode.com" class="text-light" target="_blank">WASD Netmedia Framecode</a> <?= date('Y') ?> | Develop by <a href="https://pddikti.kemdikbud.go.id/data_mahasiswa/M0RBMDVFN0ItODM3Ny00RDI4LUI3NUMtQTI3NUMxMEJEOEMz" class="text-light" target="_blank">MARIA FRANSISKA KANA MANGNGI</a>
    </p>
  </div>
</section>
<!-- footer section -->

<!-- jQery -->
<script type="text/javascript" src="<?= $baseURL ?>assets/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<!-- bootstrap js -->
<script type="text/javascript" src="<?= $baseURL ?>assets/js/bootstrap.js"></script>
<!-- owl slider -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<!-- custom js -->
<script type="text/javascript" src="<?= $baseURL ?>assets/js/custom.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
</script>
<!-- End Google Map -->

<!-- Page level plugins -->
<script src="<?= $baseURL ?>assets/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= $baseURL ?>assets/js/demo/chart-area-demo.js"></script>

<script>
  const showMessage = (type, title, message) => {
    if (message) {
      Swal.fire({
        icon: type,
        title: title,
        text: message,
      });
    }
  };

  showMessage("success", "Berhasil Terkirim", $(".message-success").data("message-success"));
  showMessage("info", "For your information", $(".message-info").data("message-info"));
  showMessage("warning", "Peringatan!!", $(".message-warning").data("message-warning"));
  showMessage("error", "Kesalahan", $(".message-danger").data("message-danger"));
</script>