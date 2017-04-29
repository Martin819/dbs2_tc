<div class="modal fade" id="add_invoice_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
    <div class="modal-dialog" role="document">

        <div class="modal-content">

          <div class="modal-header">

            <h2 class="modal-title" id="exampleModalLabel">Přidat zakázku</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>

          <form method="POST" id="add_invoice_form" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">

            <div class="modal-body">
              <div class="form-group">
                  <label for="type">Typ:</label>
                  <input type="text" class="form-control" id="type" name="type" v-model="form.type" placeholder="1 nebo 2" required>
                  <span class="small text-danger" v-if="form.errors.has('type')" v-text="form.errors.get('type')"></span>
              </div>

              <div class="form-group">
                  <label for="startDest">Počáteční adresa:</label>
                  <input type="text" class="form-control" id="startDest" name="startDest" v-model="form.startDest" required>
                  <span class="small text-danger" v-if="form.errors.has('startDest')" v-text="form.errors.get('startDest')"></span>
              </div>

              <div class="form-group">
                  <label for="finalDest">Cílová adresa:</label>
                  <input type="text" class="form-control" id="finalDest" name="finalDest" v-model="form.finalDest" required>
                  <span class="small text-danger" v-if="form.errors.has('finalDest')" v-text="form.errors.get('finalDest')"></span>
              </div>

              <div class="form-group">
                  <label for="distance">Vzdálenost:</label>
                  <input type="text" class="form-control" id="distance" name="distance" v-model="form.distance" placeholder="0 km" required>
                  <span class="small text-danger" v-if="form.errors.has('distance')" v-text="form.errors.get('distance')"></span>
              </div>

              <div class="form-group">
                  <label for="price">Cena:</label>
                  <input type="text" class="form-control" id="price" name="price" v-model="form.price" placeholder="0.00" required>
                  <span class="small text-danger" v-if="form.errors.has('price')" v-text="form.errors.get('price')"></span>
              </div>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Přidat</button>
            </div>

          </form>

        </div>

    </div>

</div>