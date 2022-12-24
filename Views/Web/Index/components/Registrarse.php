<div class="widget-section global-padding">
    <div class="featured-section global-radius" style="display: flex; flex-wrap: wrap;">
        <div class="left" style="min-width: 200px;">
            <img class="global-radius" src="<?php echo path_recursos() . 'Webp/' . $data['componentes']['register']['content']['img'] ?>" alt="cargando..." style="width: 200px;">
        </div>
        <div class="messageFormRegisterNewMember right ml-4" style="min-width: 400px; display: none;">
            <h2 class="w-100 m-0 mb-2">Felicidades!</h2>
            <p class="message w-100">se ha registrado correctamente</p>
        </div>
        <div class="formRegisterNewMember right ml-4" style="min-width: 400px;">
            <div id="preloder" style=" display: none;">
                <div class="loader"></div>
            </div>
            <h1 class="item-title">Solo para mienbros</h1>
            <p class="featured-subtitle" style="text-align: left;opacity: var(--opacity-one);">Si es integrante o baila con nosotros.Le pedimos se registre ingresando unos cuantos datos.</p>
            <form id="frmregister" onsubmit="saveRegister(this,event)">
                <input type="hidden" name="_token" value="<?php echo $data['csrf'] ?>">
                <div style="width: 100%;">
                    <div class="mb-4">
                        <input class="form-control form-livedoc-control" id="txtdni" name="txtdni" type="text" placeholder="DNI" autocomplete="off" maxlength="8" onkeydown="return limitar(event,this.value,8)" onkeyup="buscarDni(this)">
                        <input class="form-control form-livedoc-control name" id="txtnom" name="txtnom" type="text" placeholder="Nombre" autocomplete="off" style="display: none;">
                        <input class="form-control form-livedoc-control phone" id="txtcel" name="txtcel" type="text" placeholder="Celular" autocomplete="off" onkeydown="return limitar(event,this.value,9)">
                    </div>
                    <div>
                        <label class="content-input">
                            <input type="checkbox" name="apoderado" id="apoderado" onchange="viewApoderado(this)">
                            <i></i>
                            <span style="opacity: var(--opacity-one);">Soy menor de edad</span>
                        </label>
                        <div class="mb-4 section-apoderado-hidden">
                            <input class="form-control form-livedoc-control" id="txtdniapo" name="txtdniapo" type="text" placeholder="DNI del apoderado" autocomplete="off" maxlength="8" onkeydown="return limitar(event,this.value,8)" onkeyup="buscarDni(this)">
                            <input class="form-control form-livedoc-control name" id="txtnomapo" name="txtnomapo" type="text" placeholder="Nombre del apoderado" autocomplete="off" style="display: none;">
                            <input class="form-control form-livedoc-control phone" id="txtcelapo" name="txtcelapo" type="text" placeholder="Celular del apoderado" autocomplete="off" onkeydown="return limitar(event,this.value,9)">
                        </div>
                    </div>
                    <div>
                        <select class="form-control-select mb-4" name="txtcede" id="txtcede" style="width: auto;">
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                    <div class="formMessageValdiation mb-4"></div>
                    <div>
                        <button class="global-button f-s" type="submit">
                            registrarme
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>