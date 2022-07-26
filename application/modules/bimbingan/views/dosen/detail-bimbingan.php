<div class="container-fluid">
  <div class="row mt-5 mb-5">
    <div class="col-md-6">
      <div class="card file-show">
        <div class="card-body file-show-box">
          <div id="adobe-dc-view"></div>
          </iframe>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card chat">
        <div class="block">
          <div class="user-block">
            <div class="user-img">
              <img src="<?= base_url('assets/vendor/images/profile.png') ?>" alt="" srcset="">
            </div>
            <div class="user-desc">
              <ol>
                <li class="name"><?= $mhsBabDetail['mhs_name'] ?></li>
                <li>Mahasiswa Bimbingan</li>

              </ol>
            </div>

          </div>
        </div>


        <div class="body-box">
          <div class="chat-box" id="catatan">


          </div>
        </div>
        <div class="typing-message">
          <form class="typing" id="type">
            <textarea placeholder="Ketik Catatan" rows="2" id="content" name="content"></textarea>
            <button class="btn btn-send" id="send" type="button"><i class="fas fa-paper-plane"></i></button>
          </form>
        </div>



      </div>
    </div>
  </div>
</div>
<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
<!-- <script src="https://documentcloud.adobe.com/view-sdk/main.js"></script> -->
<script type="text/javascript">
  document.addEventListener("adobe_dc_view_sdk.ready", function() {
    var adobeDCView = new AdobeDC.View({
      clientId: "89b471e6fc18483f977ce6fc688d66f3",
      divId: "adobe-dc-view"
    });
    adobeDCView.previewFile({
      content: {
        location: {
          url: "<?= base_url('file/laporan/' . $mhsBabDetail['file']) ?>"
        }
      },
      metaData: {
        fileName: "<?= $mhsBabDetail['file'] ?>"
      }
    }, {});
  });
</script>
<script>
  const contents = document.getElementById("content")
  const send = document.getElementById("send")
  const renderCatatan = async () => {
    const catatan = document.getElementById("catatan")
    let listCatatan = []
    listCatatan = await ambilDataCatatan()
    catatan.innerHTML = listCatatan.catatan.map(item => {
      return `<div class="chat-right">
              <div class="message">
                <p>${item.correction}</p>
              </div>
              <div class="chat-time">
                <p>${item.date_created}</p>
              </div>
            </div>`
    }).join('')
    scrollToBottom()
  }
  send.onclick = () => {
    // console.log('sds')
    const form = new FormData()
    form.append('content', contents.value)
    form.append('id_bimbingan', '<?= $mhsBabDetail['id_bimbingan'] ?>')
    form.append('dosen_id', '<?= $dosen['id_dosen'] ?>')
    fetch('<?= base_url('bimbingan/tambah_catatan') ?>', {
        method: "POST",
        body: form
      })
      .then(d => {
        document.getElementById("type").reset()
        scrollToBottom()
        return d.json()
      })
      .catch(err => console.log(err))
    renderCatatan()
  }


  const scrollToBottom = () => {
    const catatan = document.getElementById("catatan")
    catatan.scrollTop = catatan.scrollHeight
  }

  const ambilDataCatatan = () => {
    return fetch('<?= base_url('bimbingan/catatan/' . $mhsBabDetail['id_bab_dosen'] . '/' . $mhsBabDetail['id_bimbingan']) ?>')
      .then(response => {
        if (response.ok) {
          return response.json();
        } else {
          console.log('ga keambil')
        }

      })
      .then(d => d)
      .catch(e => console.log(e))
  };

  document.addEventListener('DOMContentLoaded', () => {
    const catatan = document.getElementById("catatan")
    renderCatatan()
    setInterval(async () => {
      renderCatatan()
    }, 5000)

  })
</script>