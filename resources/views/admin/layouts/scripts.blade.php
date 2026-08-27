<script src="{{ asset('public/libs/tabler/dist/js/tabler.min.js') }}" defer></script>
<script src="{{ asset('public/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('public/libs/Parsley.js-2.9.2/parsley.min.js') }}"></script>
<!-- datatables -->
<script src="{{ asset('/public/libs/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('/public/libs/datatables/plugins/bs5/js/dataTables.bootstrap5.min.js') }}"></script>

<script src="{{ asset('/public/libs/datatables/plugins/buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/plugins/buttons/js/buttons.bootstrap5.min.js') }}"></script>

<script src="{{ asset('/public/libs/datatables/plugins/responsive/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/plugins/responsive/js/responsive.bootstrap5.min.js') }}"></script>

<script src="{{ asset('sweetalert2/script.js') }}"></script>

@stack('libs-js')
<script type="module" src="{{ asset('public/admin/assets/js/i18n.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/setup.js') }}"></script>
<script src="{{ asset('/public/libs/firebase/firebase.js') }}"></script>
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&language=vi&callback=initMaps"
    async defer></script>
<script>
    function handleAjaxErrorNew(errors) {
        if (errors.status == 416 || errors.status == 422) {
            $.map(errors.responseJSON.errors, function(value) {
                value.forEach(element => {
                    showToastify('error', 'Lỗi', element);
                })
            })
        } else {
            showToastify('error', 'Lỗi', 'Vui lòng tải lại trang');
        }
    }

    function initMaps() {
        try {
            if (typeof initMap === 'function') {
                initMap();
            }
            if (typeof initEndMap === 'function') {
                initEndMap();
            }

        } catch (error) {
            handleAjaxErrorNew();
            window.location.reload();
        }
    }

    function disableSubmitButton(button) {
        button.disabled = true;
        button.innerHTML = 'Đang xử lý...';
        button.style.color = '#ffffff';
        button.closest('form').submit();
    }
    navigator.serviceWorker.addEventListener('message', function(event) {
        if (event.data && event.data.type === "push-notification") {
            const messageData = event.data.payload;

            // Hiển thị SweetAlert2
            showToastify('info', 'Nhận được thông báo', messageData.notification.body);
        }
    });

    (function() {
        const subtleBgClasses = [
            'bg-primary-subtle',
            'bg-success-subtle',
            'bg-info-subtle',
            'bg-warning-subtle',
            'bg-danger-subtle',
        ];

        function applyRandomHeaderBg(root = document) {
            const headers = root.querySelectorAll('.card-header');
            headers.forEach(h => {
                subtleBgClasses.forEach(cls => h.classList.remove(cls));
                const random = subtleBgClasses[Math.floor(Math.random() * subtleBgClasses.length)];
                h.classList.add(random, 'text-dark');
            });
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => applyRandomHeaderBg());
        } else {
            applyRandomHeaderBg();
        }
    })();
</script>
@stack('custom-js')


<script>
    if (window.jQuery && $.fn && $.fn.dataTable) {
        $.fn.dataTable.ext.errMode = function (settings, helpPage, message) {
            console.error('DataTables Exception:', message);
            if (typeof window.showToastify === 'function') {
                window.showToastify('error', 'Lỗi DataTables', message);
            } else if (typeof window.msgError === 'function') {
                window.msgError(message);
            }
        };
    }
</script>