(() => {
    'use strict';

    function initForm(form) {
        const message = form.querySelector('.contact__msg');
        const submitButtons = [...form.querySelectorAll('[type="submit"]')];
        // Set data-endpoint when the server handler is ready.
        // Expected JSON: { success: true, message: "..." }.
        // WordPress-style { success: true, data: { message: "..." } } is also supported.
        const endpoint = form.dataset.endpoint;
        let submitting = false;

        const showMessage = (text, state) => {
            if (!message) return;
            message.classList.remove('alert-success', 'alert-danger', 'alert-info');
            message.classList.add(`alert-${state}`);
            message.textContent = text;
            message.hidden = false;
        };

        if (!endpoint) {
            submitButtons.forEach((button) => {
                button.disabled = false;
            });
            showMessage(
                'Отправка формы пока недоступна. Свяжитесь с нами по телефону или email.',
                'info',
            );
        } else {
            submitButtons.forEach((button) => {
                button.disabled = false;
            });
            if (message) message.hidden = true;
        }

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            if (!endpoint || submitting || !form.reportValidity()) return;

            const data = new FormData(form);
            if (event.submitter?.name) data.append(event.submitter.name, event.submitter.value);
            const controller = new AbortController();
            const timeout = window.setTimeout(() => controller.abort(), 20000);
            const previousDisabled = submitButtons.map((button) => button.disabled);

            submitting = true;
            form.setAttribute('aria-busy', 'true');
            submitButtons.forEach((button) => {
                button.disabled = true;
            });
            showMessage('Отправляем сообщение…', 'info');

            try {
                const response = await fetch(endpoint, {
                    method: 'POST',
                    body: data,
                    headers: { Accept: 'application/json' },
                    signal: controller.signal,
                });
                // Do not mistake an HTML error page for a successful submission.
                if (!response.headers.get('content-type')?.includes('application/json')) {
                    throw new Error('Не удалось отправить сообщение. Попробуйте позже.');
                }
                const result = await response.json();
                const responseMessage = result?.data?.message ?? result?.message;
                if (!response.ok || result?.success !== true) {
                    throw new Error(
                        typeof responseMessage === 'string' && responseMessage.trim()
                            ? responseMessage
                            : 'Не удалось отправить сообщение. Попробуйте позже.',
                    );
                }
                showMessage(
                    typeof responseMessage === 'string' && responseMessage.trim()
                        ? responseMessage
                        : 'Сообщение отправлено. Спасибо за обращение!',
                    'success',
                );
                form.reset();
            } catch (error) {
                const text =
                    error.name === 'AbortError'
                        ? 'Сервер не ответил вовремя. Попробуйте позже.'
                        : error instanceof TypeError
                          ? 'Не удалось связаться с сервером. Проверьте соединение и попробуйте ещё раз.'
                          : error.message || 'Не удалось отправить сообщение. Попробуйте позже.';
                showMessage(text, 'danger');
            } finally {
                window.clearTimeout(timeout);
                submitting = false;
                form.removeAttribute('aria-busy');
                submitButtons.forEach((button, index) => {
                    button.disabled = previousDisabled[index];
                });
            }
        });
    }

    function init() {
        document.querySelectorAll('.contact__form').forEach(initForm);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init, { once: true });
    } else {
        init();
    }
})();
