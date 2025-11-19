/**
* jQuery West Slide
* @version 1.0.0
* @author Willian West [ @willianwest ]
* @license The MIT License (MIT)
*/

(function($) {
    $.fn.westSlide = function(options) {

        // Configurações padrão do plugin
        const defaults = {

            slideMargin: 0,                 // Margem entre os slides (em pixels)

            speed: '2',                     // Duração da transição

            factorMoveScroll: 1,            // Fator de amplificação mo scroll

            wheelScroll: true,              // Habilita o scroll via roda do mouse

            scrollSmoothPage: true,         // Desabilita o scrollSmoothPage enquanto o slide não checar no final
        };
        

        // Mescla as opções do usuário com as opções padrão
        const settings = $.extend({}, defaults, options);


        // Função principal do slider
        return this.each(function() {
            const $container = $(this); // Seleciona o container principal
            const $items     = $container.children('.item'); // Seleciona os itens deslizáveis
            
            $container.addClass('west-stage-outer');

            // Verifica se já existe a div .west-stage, senão cria
            if (!$container.find('.west-stage').length) {
                const $content = $('<div class="west-stage"></div>'); // Cria a div .west-stage

                // Move todos os itens .item para dentro da div .west-stage
                $items.appendTo($content);

                // Adiciona a div .west-stage dentro do container principal
                $container.append($content);
            }

            const $content      = $container.find('.west-stage'); // Seleciona o conteúdo deslizável
            const totalItems    = $items.length; // Número total de itens

            // Ajusta a margem entre os slides
            $items.css('margin-bottom', `${settings.slideMargin}px`);


            // Garantir que a velocidade seja numérica
            const speed = isNaN(Number(settings.speed)) ? 2 : Number(settings.speed);

            // Adiciona transição suave
            $content.css('transition', `transform ${speed}s cubic-bezier(0.19, 0.44, 0.15, 1)`);


            // Largura de um item (inclui a margem direita)
            let itemHeight      = $items.outerHeight(true); // outerHeight(true) inclui margens
            let containerHeight = $container.outerHeight(); // Largura do contêiner visível

            // Novo cálculo para o maxTranslateY considerando a largura do contêiner visível
            let maxTranslateY = Math.min(0, containerHeight - (totalItems * itemHeight)); 

            
            let currentTranslateY = 0, prevTranslateY = 0;


            // Função debounce para o resize
            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this, args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }



            // Função para atualizar variáveis importantes no resize
            function updateDimensions() {
                itemHeight      = $items.outerHeight(true); // Atualiza a largura de cada item
                containerHeight = $container.outerHeight(); // Atualiza a largura do container
                maxTranslateY   = Math.min(0, containerHeight - ($items.length * itemHeight)); // Recalcula o limite

                // Reposiciona o conteúdo se necessário 
                if (currentTranslateY < maxTranslateY) {
                    currentTranslateY = maxTranslateY;
                    applyTransform(currentTranslateY);
                } else if (currentTranslateY > 0) {
                    currentTranslateY = 0;
                    applyTransform(currentTranslateY);
                }
            }


            // Aplica a transformação de translateY
            function applyTransform(value) {
                $content.css('transform', `translateY(${value}px)`);
            }


            // Inicializa a variável global __Scroll.activeScrollPage se necessário
            if (typeof __Scroll.activeScrollPage === 'undefined') {
                window.__Scroll.activeScrollPage = true;
            }


            // Função para habilitar/desabilitar o scroll suave da página
            function togglePageScroll(enable) {
                if (settings.scrollSmoothPage && typeof __Scroll.activeScrollPage !== 'undefined') {
                    __Scroll.activeScrollPage = enable;
                }
            }



            // Scroll via roda do mouse (opcional)
            if (settings.wheelScroll)
            {
                $container.on('wheel', function(e) {
                    e.preventDefault();
                    const deltaY = e.originalEvent.deltaY;

                    currentTranslateY -= deltaY * settings.factorMoveScroll;

                    

                    // Limita o movimento para não ultrapassar os limites
                    if (currentTranslateY > 0)
                    {
                        currentTranslateY = 0;

                        // ENABLE SCROLL PAGE SMOOTH
                        togglePageScroll(true);

                    } else if (currentTranslateY < maxTranslateY) {
                        currentTranslateY = maxTranslateY;

                        // ENABLE SCROLL PAGE SMOOTH
                        togglePageScroll(true);
                    } else{
                        // DISABLE SCROLL PAGE SMOOTH
                        togglePageScroll(false);
                    }

                    applyTransform(currentTranslateY);
                    prevTranslateY = currentTranslateY;
                });
            }


            // Evento de resize para recalcular variáveis importantes
            $(window).on('resize', debounce(updateDimensions, 150));

            // Inicializa as dimensões
            updateDimensions();

        });
    };
})(jQuery);