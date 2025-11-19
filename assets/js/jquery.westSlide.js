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

            factorMoveDrag: 2.5,            // Fator de amplificação ao arrastar
            
            factorMoveScroll: 1,            // Fator de amplificação mo scroll

            snap: true,                     // Snap para ajustar ao item mais próximo

            wheelScroll: true,              // Habilita o scroll via roda do mouse

            scrollSmoothPage: true,         // Desabilita o scrollSmoothPage enquanto o slide não checar no final

            moveSlideTopOnScroll: true,     // Move o slide para o topo da página no scroll

            moveSlideTopOffSet: 100,        // Quant de descolacamento até o topo

            offSetDrag: 800,                // Para passar um pouco do limite no arrasto, depois ele volta sozinho

            offSetScroll: 600,              // O quanto pode ser rolado(scroll) a mais antes do scroll da página assumir o controle
        };
        

        // Mescla as opções do usuário com as opções padrão
        const settings = $.extend({}, defaults, options);


        // Função principal do slider
        return this.each(function() {
            const $container = $(this); // Seleciona o container principal
            const $items = $container.children('.item'); // Seleciona os itens deslizáveis
            
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
            $items.css('margin-right', `${settings.slideMargin}px`);


            // Garantir que a velocidade seja numérica
            const speed = isNaN(Number(settings.speed)) ? 2 : Number(settings.speed);

            // Adiciona transição suave
            $content.css('transition', `transform ${speed}s cubic-bezier(0.19, 0.44, 0.15, 1)`);


            // Largura de um item (inclui a margem direita)
            let itemWidth      = $items.outerWidth(true); // outerWidth(true) inclui margens
            let containerWidth = $container.outerWidth(); // Largura do contêiner visível

            // Novo cálculo para o maxTranslateX considerando a largura do contêiner visível
            let maxTranslateX = Math.min(0, containerWidth - (totalItems * itemWidth)); 

            
            let isDragging      = false;
            let startX, currentTranslateX = 0, prevTranslateX = 0;
            let animationId;


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
                itemWidth       = $items.outerWidth(true); // Atualiza a largura de cada item
                containerWidth  = $container.outerWidth(); // Atualiza a largura do container
                maxTranslateX   = Math.min(0, containerWidth - ($items.length * itemWidth)); // Recalcula o limite

                // Reposiciona o conteúdo se necessário 
                if (currentTranslateX < maxTranslateX) {
                    currentTranslateX = maxTranslateX;
                    applyTransform(currentTranslateX);
                } else if (currentTranslateX > 0) {
                    currentTranslateX = 0;
                    applyTransform(currentTranslateX);
                }
            }


            // Aplica a transformação de translateX
            function applyTransform(value) {
                $content.css('transform', `translateX(${value}px)`);
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





            // Mousedown: inicia arrasto
            $container.on('mousedown', function(e) {
                isDragging = true;
                $content.css('cursor', 'grabbing');
                $container.addClass('west-grab');
                startX = e.clientX;
                cancelAnimationFrame(animationId);
            });


            // Mouseleave/Mouseup: termina arrasto
            $container.on('mouseleave mouseup', function() {
                if (isDragging && settings.snap) {
                    snapToDiv(); // Ajusta o slider para o item mais próximo
                }
                isDragging = false;
                $content.css('cursor', 'grab');
                $container.removeClass('west-grab');
            });


            // Mousemove: movimenta os itens enquanto arrasta
            $container.on('mousemove', function(e) {
                if (!isDragging) return;
                const currentX = e.clientX;
                let deltaX = (currentX - startX) * settings.factorMoveDrag;
                currentTranslateX = prevTranslateX + deltaX;

                // Limita o movimento para não ultrapassar os limites do conteúdo
                if (currentTranslateX > 0) {
                    currentTranslateX = 0;
                } else if (currentTranslateX + settings.offSetDrag < maxTranslateX) {
                    currentTranslateX = maxTranslateX;
                }

                requestAnimationFrame(() => {
                    applyTransform(currentTranslateX);
                });
            });


            // Snap para ajustar ao item mais próximo
            function snapToDiv() {
                const nearestIndex = Math.round(-currentTranslateX / itemWidth);
                currentTranslateX = -nearestIndex * itemWidth;

                // Limita para não ultrapassar o último item
                if (currentTranslateX + settings.offSetScroll < maxTranslateX) {
                    currentTranslateX = maxTranslateX;
                }

                prevTranslateX = currentTranslateX;
                applyTransform(currentTranslateX);
            }


            // Scroll via roda do mouse (opcional)
            if (settings.wheelScroll) {
                $container.on('wheel', function(e) {
                    e.preventDefault();
                    const deltaX = e.originalEvent.deltaY;

                    currentTranslateX -= deltaX * settings.factorMoveScroll;


                    if (settings.moveSlideTopOnScroll) {
                        if (typeof __Scroll.smoothScrollTo === 'function') {
                            __Scroll.smoothScrollTo('.west-stage-outer', -settings.moveSlideTopOffSet);
                        }
                    }


                    // Limita o movimento para não ultrapassar os limites
                    if (currentTranslateX > 0) {
                        currentTranslateX = 0;

                        // ENABLE SCROLL PAGE SMOOTH
                        togglePageScroll(true);

                    } else if (currentTranslateX < maxTranslateX) {
                        currentTranslateX = maxTranslateX;

                        // ENABLE SCROLL PAGE SMOOTH
                        togglePageScroll(true);
                    } else{
                        // DISABLE SCROLL PAGE SMOOTH
                        togglePageScroll(false);
                    }

                    applyTransform(currentTranslateX);
                    prevTranslateX = currentTranslateX;
                });
            }


            // Evento de resize para recalcular variáveis importantes
            $(window).on('resize', debounce(updateDimensions, 150));

            // Inicializa as dimensões
            updateDimensions();

        });
    };
})(jQuery);