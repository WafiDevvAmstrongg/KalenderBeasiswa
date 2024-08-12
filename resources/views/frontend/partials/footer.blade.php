    <!-- Include Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Include Moment.js Locale for Indonesian -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <!-- SB Forms JS-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set moment.js to use Indonesian locale
            moment.locale('id');

            // Format all date elements on the page
            document.querySelectorAll('.date-registrasi').forEach(function(element) {
                let date = element.textContent.trim();
                let formattedDate = moment(date, 'YYYY-MM-DD').format('DD MMMM YYYY');
                element.textContent = formattedDate;
            });

            document.querySelectorAll('.date-deadline').forEach(function(element) {
                let date = element.textContent.trim();
                let formattedDate = moment(date, 'YYYY-MM-DD').format('DD MMMM YYYY');
                element.textContent = formattedDate;
            });
        });
    </script>

    <!-- Footer -->
    <footer class="bg-light py-5">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">Copyright &copy; 2024 - Beasiswa.ID</div>
        </div>
    </footer>
</body>

</html>
