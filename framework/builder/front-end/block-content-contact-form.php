<?php
/**
 * Block Name: Contact Form
 */

$form_title = get_field('form_title');
$form_description = get_field('form_description');
$select_form  = get_field('select_form');

// Map icon
$map_icon_field = get_field('map_pin');
$map_icon_url = (!empty($map_icon_field) && isset($map_icon_field['url'])) ? esc_url($map_icon_field['url']) : 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';

$phone_number_label = get_field('phone_number_label');
$fax_label = get_field('fax_label');
$email_label = get_field('email_label');
$address_label = get_field('address_label');
?>

<section class="contact-form" id="form">
    <div class="wrraper">
        <div class="form-wrraper h-100">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-md-4 form form-icons">
                        <h2 class="form_title primary-font font-42"><?= esc_html($form_title) ?></h2>
                        <p class="form_description"><?= esc_html($form_description) ?></p>
                        <div class="spacer-10"></div>
                        <?php
                        if ($select_form):
                            echo do_shortcode('[gravityform id="' . intval($select_form['id']) . '" title="false" description="false" ajax="true"]');
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-md-9 map">
                <?php if (have_rows('locations')): ?>
                <div class="position-relative w-100 h-100">
                    <div class="acf-map w-100 h-100">
                    <?php while (have_rows('locations')): the_row();
                        $flag_icon = get_sub_field('flag_icon');
                        $flag_icon_url = ($flag_icon && isset($flag_icon['url'])) ? esc_url($flag_icon['url']) : '';
                        $title = get_sub_field('title');
                        $phone_number = get_sub_field('phone_number');
                        $fax = get_sub_field('fax');
                        $email = get_sub_field('email');
                        $address = get_sub_field('address');
                        $location = get_sub_field('location');

                        $phone_title = is_array($phone_number) && isset($phone_number['title']) ? $phone_number['title'] : '';
                        $phone_url = is_array($phone_number) && isset($phone_number['url']) ? $phone_number['url'] : '';
                        $fax_title   = is_array($fax) && isset($fax['title']) ? $fax['title'] : '';
                        $fax_url   = is_array($fax) && isset($fax['url']) ? $fax['url'] : '';
                        $email_title = is_array($email) && isset($email['title']) ? $email['title'] : '';
                        $email_url = is_array($email) && isset($email['url']) ? $email['url'] : '';
                        $address_title = is_array($address) && isset($address['title']) ? $address['title'] : '';
                        $address_url = is_array($address) && isset($address['url']) ? $address['url'] : '';
                    ?>
                        <div class="marker"
                        data-lat="<?= ($location) ? esc_attr($location['lat']) : '' ?>"
                        data-lng="<?= ($location) ? esc_attr($location['lng']) : '' ?>"
                        data-icon="<?= $map_icon_url ?>"
                        data-flag="<?= esc_url($flag_icon_url) ?>"
                        data-title="<?= esc_attr($title) ?>"
                        data-phone-title="<?= esc_attr($phone_title) ?>"
                        data-phone="<?= esc_attr($phone_url) ?>"
                        data-fax="<?= esc_attr($fax_url) ?>"
                        data-fax-title="<?= esc_attr($fax_title) ?>"
                        data-email="<?= esc_attr($email_url) ?>"
                        data-email-title="<?= esc_attr($email_title) ?>"
                        data-address="<?= esc_attr($address_url) ?>"
                        data-address-title="<?= esc_attr($address_title) ?>"
                        ></div>
                    <?php endwhile; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3 p-md-4">
      <div class="modal-header p-0 mb-3 border-0 justify-content-between">
        <div class="modal-title d-flex gap-2" id="exampleModalLabel">
            <img id="modal-flag" src="" alt="" style="width:22px;height:22px;">
            <h3 class="mb-0 font-22 primary-font" id="modal-title"></h3>
        </div>
        <div class="pointer" data-bs-dismiss="modal" aria-label="Close">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="12" fill="white"/>
                <path d="M17.5304 16.4697C17.2375 16.1768 16.7626 16.1768 16.4697 16.4696C16.1768 16.7625 16.1768 17.2374 16.4696 17.5303L18.9394 20.0003L16.4703 22.4697C16.1774 22.7626 16.1774 23.2375 16.4703 23.5304C16.7632 23.8232 17.2381 23.8232 17.531 23.5303L20 21.061L22.469 23.5303C22.7619 23.8232 23.2368 23.8232 23.5297 23.5304C23.8226 23.2375 23.8226 22.7626 23.5297 22.4697L21.0606 20.0003L23.5304 17.5303C23.8232 17.2374 23.8232 16.7625 23.5303 16.4696C23.2374 16.1768 22.7625 16.1768 22.4696 16.4697L20 18.9396L17.5304 16.4697Z" fill="#8E1808"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M20 30.75C14.0629 30.75 9.25 25.9371 9.25 20C9.25 14.0629 14.0629 9.25 20 9.25C25.9371 9.25 30.75 14.0629 30.75 20C30.75 25.9371 25.9371 30.75 20 30.75ZM10.75 20C10.75 25.1086 14.8914 29.25 20 29.25C25.1086 29.25 29.25 25.1086 29.25 20C29.25 14.8914 25.1086 10.75 20 10.75C14.8914 10.75 10.75 14.8914 10.75 20Z" fill="#8E1808"/>
            </svg>
        </div>
      </div>
      <div class="modal-body text-center p-0">
        <div class="row g-2 g-md-4">
            <div class="col-md-6 text-start">
                <label class="font-18 d-block text-blue800"><?= esc_html($phone_number_label); ?></label>
                <a class="text-blue800" href="#" id="modal-phone" target="_blank"></a>
            </div>
            <div class="col-md-6 text-start">
                <label class="font-18 d-block text-blue800"><?= esc_html($fax_label); ?></label>
                <a class="text-blue800" href="#" id="modal-fax" target="_blank"></a>
            </div>
            <div class="col-md-6 text-start">
                <label class="font-18 d-block text-blue800"><?= esc_html($email_label); ?></label>
                <a class="text-blue800" href="#" id="modal-email" target="_blank"></a>
            </div>
            <div class="col-md-6 text-start">
                <label class="font-18 d-block text-blue800"><?= esc_html($address_label); ?></label>
                <a class="text-decoration-underline" style="color: #1647A4" href="#" id="modal-address" target="_blank"></a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9_qsnnns_d8gSnDWKx45ag2PPE-HISoo&callback=Function.prototype"></script>
<script>
(function($){

  function initMap($el){
    var $markers = $el.find('.marker');
    var mapArgs = {
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      streetViewControl: false,
      mapTypeControl: false,
      fullscreenControl: true,
    };

    var map = new google.maps.Map($el[0], mapArgs);
    map.markers = [];

    $markers.each(function(){
      initMarker($(this), map);
    });

    // Add an overlay that covers the entire map
    new FullMapOverlay(map, 'linear-gradient(180deg, rgba(48, 48, 48, 0) 0%, #141504 100%)'); // Transparent gray color

    centerMap(map);
  }

  // ===== Overlay that covers the entire map =====
  function FullMapOverlay(map, color) {
    this.map = map;
    this.color = color || 'linear-gradient(180deg, rgba(48, 48, 48, 0) 0%, #141504 100%);';
    this.div = null;
    this.setMap(map);
  }

  FullMapOverlay.prototype = new google.maps.OverlayView();

  FullMapOverlay.prototype.onAdd = function() {
    var div = document.createElement('div');
    div.style.position = 'absolute';
    div.style.background = this.color;
    div.style.top = '0';
    div.style.left = '0';
    div.style.width = '100%';
    div.style.height = '100%';
    div.style.pointerEvents = 'none'; // So it doesn't block dragging or clicking
    div.style.zIndex = '1'; // Lower than markers

    this.div = div;
    var panes = this.getPanes();
    // Put it inside mapPane so it's below markers
    panes.mapPane.appendChild(div);
  };

  FullMapOverlay.prototype.draw = function() {
    var overlayProjection = this.getProjection();
    var bounds = this.map.getBounds();
    if (!bounds || !overlayProjection) return;

    // Get the corner points to adjust the div inside the map
    var ne = overlayProjection.fromLatLngToDivPixel(bounds.getNorthEast());
    var sw = overlayProjection.fromLatLngToDivPixel(bounds.getSouthWest());

    var div = this.div;
    div.style.left = sw.x + 'px';
    div.style.top = ne.y + 'px';
    div.style.width = (ne.x - sw.x) + 'px';
    div.style.height = (sw.y - ne.y) + 'px';
  };

  FullMapOverlay.prototype.onRemove = function() {
    if (this.div && this.div.parentNode) {
      this.div.parentNode.removeChild(this.div);
      this.div = null;
    }
  };

  // ===== Create markers =====
  function initMarker($marker, map){
    var lat = parseFloat($marker.data('lat'));
    var lng = parseFloat($marker.data('lng'));
    var icon = $marker.data('icon');
    var flag = $marker.data('flag');
    var title = $marker.data('title');
    var phone = $marker.data('phone');
    var phone_title = $marker.data('phone-title');
    var fax = $marker.data('fax');
    var fax_title = $marker.data('fax-title');
    var email = $marker.data('email');
    var email_title = $marker.data('email-title');
    var address = $marker.data('address');
    var address_title = $marker.data('address-title');

    if (!icon || icon.trim() === '') {
      icon = 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';
    }

    var marker = new google.maps.Marker({
      position: { lat: lat, lng: lng },
      map: map,
      icon: {
        url: icon,
        scaledSize: new google.maps.Size(54, 80),
        anchor: new google.maps.Point(22, 80)
      },
      title: title || ''
    });

    map.markers.push(marker);

    // Small overlay that includes the flag and title
    function CustomOverlay(position, map, flag, title) {
      this.position = position;
      this.flag = flag;
      this.title = title;
      this.div = null;
      this.setMap(map);
    }

    CustomOverlay.prototype = new google.maps.OverlayView();

    CustomOverlay.prototype.onAdd = function() {
      var div = document.createElement('div');
      div.style.position = 'absolute';
      div.style.transform = 'translate(-50%, 10px)';
      div.style.textAlign = 'center';
      div.innerHTML = `
        <div style="
          background:transparent;
          color: #fff;
          padding: 5px;
          font-size:18px;
          white-space:nowrap;
          display:inline-flex;
          align-items:center;
          gap:5px;
        ">
          ${flag ? `<img src="${flag}" style="width:22px;height:22px;border-radius:50%;margin:2px">` : ''}
          <span>${title || ''}</span>
        </div>
      `;
      this.div = div;
      var panes = this.getPanes();
      panes.overlayMouseTarget.appendChild(div);
    };

    CustomOverlay.prototype.draw = function() {
      var overlayProjection = this.getProjection();
      var pos = overlayProjection.fromLatLngToDivPixel(this.position);
      var div = this.div;
      if (div) {
        div.style.left = pos.x + 'px';
        div.style.top = pos.y + 'px';
      }
    };

    CustomOverlay.prototype.onRemove = function() {
      if (this.div) {
        this.div.parentNode.removeChild(this.div);
        this.div = null;
      }
    };

    new CustomOverlay(marker.getPosition(), map, flag, title);

    marker.addListener('click', function() {
      $('#modal-flag').attr('src', flag || '');
      $('#modal-title').text(title || '');
      $('#modal-phone').attr('href', phone || '#').text(phone_title || '');
      $('#modal-fax').attr('href', fax || '#').text(fax_title || '');
      $('#modal-email').attr('href', email || '#').text(email_title || '');
      $('#modal-address').attr('href', address || '#').text(address_title || '');
      $('#exampleModal').modal('show');
    });
  }

  function centerMap(map){
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function(marker){
        bounds.extend(marker.getPosition());
    });

    map.fitBounds(bounds);

    google.maps.event.addListenerOnce(map, 'idle', function(){
        map.setZoom(map.getZoom() - 1);
    });
  }

  $(document).ready(function(){
    $('.acf-map').each(function(){
      initMap($(this));
    });
  });

})(jQuery);
</script>


