
{{-- ESTILOS ENCAPSULADOS PARA EL FOOTER --}}
     <style>
        .footer-modern { background-color: #11131A; border-top: 1px solid #1f222e !important; }
        .footer-link { color: #94a3b8; text-decoration: none; font-weight: 500; font-size: 0.95rem; transition: all 0.3s ease; display: inline-block; width: fit-content; }
        
        /* Animación UX: Al pasar el mouse, el link se pinta de rojo y avanza 5px a la derecha */
        .footer-link:hover { color: #FF3B3B !important; transform: translateX(5px); }
    
        /* Contenedor redondo de la red social */
        .social-icon-wrapper { display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background-color: #1a1d27; border: 1px solid #2d313f; border-radius: 50%; transition: all 0.3s ease; }
        
        /* Inversión de color del SVG para que sea grisáceo */
        .footer-icon { width: 18px; height: 18px; filter: invert(0.6); transition: all 0.3s ease; }
    
        /* Hover interactivo del círculo: Se eleva y genera un brillo rojo */
        .social-icon-wrapper:hover { background-color: rgba(255, 59, 59, 0.1); border-color: #FF3B3B; transform: translateY(-4px); box-shadow: 0 5px 15px rgba(255, 59, 59, 0.2); }
        /* El ícono SVG pasa de gris a blanco puro (invert 1) */
        .social-icon-wrapper:hover .footer-icon { filter: invert(1); }
    </style>
    
    <footer class="footer-modern py-5 mt-5">
        <div class="container">
            
            {{-- SISTEMA DE GRILLAS DE BOOTSTRAP (Row)
                 g-4: Agrega un gap (espacio) entre columnas para que no se peguen en celular.
                 align-items-center: Centra las 3 columnas verticalmente. --}}
            <div class="row g-4 align-items-center">
                
                {{-- COLUMNA IZQUIERDA: Navegación (Ocupa 4 de 12 espacios en PC)
                     text-center: Texto centrado en celular.
                     text-md-start: Texto alineado a la izquierda a partir de pantallas Medianas (Tablets/PC). --}}
                <div class="col-md-4 text-center text-md-start">
                    <h6 class="text-white fw-bold text-uppercase mb-3" style="letter-spacing: 1px; font-size: 0.85rem;">Explorar</h6>
                    <div class="d-flex flex-column gap-2 align-items-center align-items-md-start">
                        <a href="/" class="footer-link">Inicio</a>
                        <a href="/quienes-somos" class="footer-link">Quiénes Somos</a>
                        <a href="/catalogo" class="footer-link">Catálogo</a>
                        <a href="/contacto" class="footer-link">Contacto</a>
                        <a href="/terminos" class="footer-link">Términos</a>
                    </div>
                </div>
    
                {{-- COLUMNA CENTRAL: Marca y Copyright (Ocupa 4 de 12 espacios en PC)
                     Se fuerza el text-center para que el logo siempre quede en el medio absoluto. --}}
                <div class="col-md-4 text-center">
                    <p class="mb-2 fw-black text-uppercase fs-4 logo-text text-white" style="letter-spacing: -1.5px;">
                        GAMING<span class="text-mars">STATION</span>
                    </p>
                    <p class="text-secondary small mb-0 fw-light">
                        &copy; 2026 - Todos los derechos reservados
                    </p>
                </div>
    
                {{-- COLUMNA DERECHA: Redes Sociales (Ocupa 4 de 12 espacios en PC)
                     text-md-end: En PC empuja los elementos hacia el borde derecho. --}}
                <div class="col-md-4 text-center text-md-end">
                    <h6 class="text-white fw-bold text-uppercase mb-3" style="letter-spacing: 1px; font-size: 0.85rem;">Conecta</h6>
                    
                    {{-- Contenedor Flexbox de los círculos:
                         En celular se centran (justify-content-center).
                         En PC se tiran hacia la derecha (justify-content-md-end). --}}
                    <div class="d-flex justify-content-center justify-content-md-end gap-3">
                        
                        {{-- target="_blank": Atributo de seguridad/UX para abrir el link en una pestaña nueva --}}
                        <a href="https://www.instagram.com" target="_blank" class="social-icon-wrapper" title="Instagram">
                            <img src="{{ asset('assets/instagram.svg') }}" alt="Instagram" class="footer-icon">
                        </a>
                        
                        <a href="https://www.facebook.com" target="_blank" class="social-icon-wrapper" title="Facebook">
                            <img src="{{ asset('assets/facebook.svg') }}" alt="Facebook" class="footer-icon">
                        </a>
                        
                        <a href="https://www.whatsapp.com" target="_blank" class="social-icon-wrapper" title="WhatsApp">
                            <img src="{{ asset('assets/whatsapp.svg') }}" alt="WhatsApp" class="footer-icon">
                        </a>
                        
                        {{-- directiva mailto: Ejecuta el gestor de correos predeterminado (ej: Outlook) --}}
                        <a href="mailto:contacto@gamingstation.com.ar" class="social-icon-wrapper" title="Envíanos un correo">
                            <img src="{{ asset('assets/envelope-at.svg') }}" alt="Email" class="footer-icon">
                        </a>
                        
                    </div>
                </div>
    
            </div>
        </div>
    </footer>