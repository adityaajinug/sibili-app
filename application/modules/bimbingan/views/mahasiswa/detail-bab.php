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
              <img src="<?= base_url('assets/vendor/images/users/2.jpg') ?>" alt="" srcset="">
            </div>
            <div class="user-desc">
              <ol>
                <li class="name"><?= $detailBab['dosen_name'] ?></li>
                <li>Dosen Pembimbing</li>

              </ol>
            </div>

          </div>
        </div>


        <div class="body-box">
          <div class="chat-box" id="catatan">
            <!-- <div class="chat-left" style="border:1px red;">
              <div class="message">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, suscipit at?</p>
              </div>
              <div class="chat-time">
                <p>10.30 am</p>
              </div>
            </div> -->
            <!-- <div class="chat-right">
              <div class="message">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, suscipit at?</p>
              </div>
              <div class="chat-time">
                <p>10.30 am</p>
              </div>
            </div> -->


          </div>
        </div>
        <!-- <div class="typing-message">
          <form class="typing">
            <textarea placeholder="Ketik Pesan" rows="2"></textarea>
            <button class="btn btn-send"><i class="fas fa-paper-plane"></i></button>
          </form>
        </div> -->



      </div>
    </div>
  </div>
</div>

<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
<script type="text/javascript">
  document.addEventListener("adobe_dc_view_sdk.ready", function() {
    var adobeDCView = new AdobeDC.View({
      clientId: "89b471e6fc18483f977ce6fc688d66f3",
      divId: "adobe-dc-view"
    });
    adobeDCView.previewFile({
      content: {
        location: {
          url: "<?= base_url('file/laporan/' . $detailBab['file']) ?>"
        }
      },
      metaData: {
        fileName: "<?= $detailBab['file'] ?>"
      }
    }, {});
  });
</script>

<script>
  const contents = document.getElementById("content")
  const send = document.getElementById("send")
  const renderCatatan = async () => {
    let listCatatan = []
    listCatatan = await ambilDataCatatan()
    catatan.innerHTML = listCatatan.catatan.map(item => {
      return `<div class="chat-left">
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
  const catatan = document.getElementById("catatan")
  const ambilDataCatatan = () => {
    return fetch('<?= base_url('bimbingan/catatanmhs/'  . $detailBab['id_bimbingan']) ?>')
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

    renderCatatan()
    setInterval(async () => {
      renderCatatan()
    }, 5000)

  })
</script>