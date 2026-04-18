import './bootstrap';
import Alpine from 'alpinejs';
import 'flowbite';
import { marked } from 'marked';
import DOMPurify from 'dompurify';

window.Alpine = Alpine;
Alpine.start();

const THEME_KEY = 'ownblog-theme';

marked.setOptions({
    breaks: true,
    gfm: true,
});

const renderMarkdown = (markdown = '') => {
    const rawHtml = marked.parse(markdown || '');

    return DOMPurify.sanitize(rawHtml);
};

const getPreferredTheme = () => {
    const storedTheme = localStorage.getItem(THEME_KEY);

    if (storedTheme === 'light' || storedTheme === 'dark') {
        return storedTheme;
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
};

const updateThemeIcons = (theme) => {
    document.querySelectorAll('[data-theme-icon-light]').forEach((icon) => {
        icon.classList.toggle('hidden', theme !== 'light');
    });

    document.querySelectorAll('[data-theme-icon-dark]').forEach((icon) => {
        icon.classList.toggle('hidden', theme !== 'dark');
    });

    document.querySelectorAll('[data-theme-label]').forEach((label) => {
        label.textContent = theme === 'dark' ? 'Light mode' : 'Dark mode';
    });
};

const applyTheme = (theme) => {
    document.documentElement.setAttribute('data-theme', theme);
    document.body?.setAttribute('data-theme', theme);
    localStorage.setItem(THEME_KEY, theme);
    updateThemeIcons(theme);
};

const initThemeToggles = () => {
    const currentTheme = getPreferredTheme();
    applyTheme(currentTheme);
    updateThemeIcons(currentTheme);

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        if (button.dataset.themeBound === 'true') {
            return;
        }

        button.dataset.themeBound = 'true';
        button.addEventListener('click', () => {
            const nextTheme = (document.documentElement.getAttribute('data-theme') || currentTheme) === 'dark'
                ? 'light'
                : 'dark';

            applyTheme(nextTheme);
        });
    });
};

const wrapSelection = (textarea, prefix, suffix = prefix, fallback = 'text') => {
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selected = textarea.value.slice(start, end) || fallback;
    const before = textarea.value.slice(0, start);
    const after = textarea.value.slice(end);
    const nextValue = `${before}${prefix}${selected}${suffix}${after}`;

    textarea.value = nextValue;
    textarea.focus();
    textarea.setSelectionRange(start + prefix.length, start + prefix.length + selected.length);
    textarea.dispatchEvent(new Event('input', { bubbles: true }));
};

const insertLinePrefix = (textarea, prefix) => {
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const value = textarea.value;
    const lineStart = value.lastIndexOf('\n', start - 1) + 1;
    const selected = value.slice(lineStart, end);
    const updated = `${value.slice(0, lineStart)}${prefix}${selected}${value.slice(end)}`;

    textarea.value = updated;
    textarea.focus();
    textarea.setSelectionRange(lineStart + prefix.length, lineStart + prefix.length + selected.length);
    textarea.dispatchEvent(new Event('input', { bubbles: true }));
};

const insertBlock = (textarea, block, selectionStartOffset = 0, selectionEndOffset = 0) => {
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const before = textarea.value.slice(0, start);
    const after = textarea.value.slice(end);
    const needsLeadingBreak = before.length > 0 && !before.endsWith('\n') ? '\n\n' : '';
    const needsTrailingBreak = after.length > 0 && !after.startsWith('\n') ? '\n\n' : '';
    const insertValue = `${needsLeadingBreak}${block}${needsTrailingBreak}`;
    const nextValue = `${before}${insertValue}${after}`;
    const cursorBase = before.length + needsLeadingBreak.length;

    textarea.value = nextValue;
    textarea.focus();
    textarea.setSelectionRange(cursorBase + selectionStartOffset, cursorBase + selectionEndOffset);
    textarea.dispatchEvent(new Event('input', { bubbles: true }));
};

const initMarkdownEditors = () => {
    document.querySelectorAll('[data-markdown-editor]').forEach((editor) => {
        if (editor.dataset.editorBound === 'true') {
            return;
        }

        editor.dataset.editorBound = 'true';

        const titleInput = editor.querySelector('[data-markdown-title]');
        const slugInput = editor.querySelector('[data-markdown-slug]');
        const contentInput = editor.querySelector('[data-markdown-input]');
        const preview = editor.querySelector('[data-markdown-preview]');
        const emptyState = editor.querySelector('[data-markdown-empty]');

        const syncSlug = () => {
            if (!titleInput || !slugInput || slugInput.dataset.slugLocked === 'true') {
                return;
            }

            const slug = titleInput.value
                .trim()
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w-]+/g, '')
                .replace(/--+/g, '-')
                .replace(/^-+|-+$/g, '');

            slugInput.value = slug;
        };

        const syncPreview = () => {
            if (!contentInput || !preview) {
                return;
            }

            const markdown = contentInput.value.trim();

            if (markdown.length === 0) {
                preview.innerHTML = '';
                emptyState?.classList.remove('hidden');
                return;
            }

            emptyState?.classList.add('hidden');
            preview.innerHTML = renderMarkdown(markdown);
        };

        titleInput?.addEventListener('input', syncSlug);
        contentInput?.addEventListener('input', syncPreview);

        editor.querySelectorAll('[data-md-action]').forEach((button) => {
            button.addEventListener('click', () => {
                if (!contentInput) {
                    return;
                }

                const action = button.dataset.mdAction;

                switch (action) {
                    case 'heading':
                        insertLinePrefix(contentInput, '## ');
                        break;
                    case 'bold':
                        wrapSelection(contentInput, '**', '**', 'bold text');
                        break;
                    case 'italic':
                        wrapSelection(contentInput, '_', '_', 'italic text');
                        break;
                    case 'quote':
                        insertLinePrefix(contentInput, '> ');
                        break;
                    case 'list':
                        insertLinePrefix(contentInput, '- ');
                        break;
                    case 'table': {
                        const tableTemplate = [
                            '| Column 1 | Column 2 | Column 3 |',
                            '| --- | --- | --- |',
                            '| Value 1 | Value 2 | Value 3 |',
                            '| Value 4 | Value 5 | Value 6 |',
                        ].join('\n');
                        insertBlock(contentInput, tableTemplate, 2, 10);
                        break;
                    }
                    case 'code':
                        wrapSelection(contentInput, "```md\n", "\n```", 'your code');
                        break;
                    case 'link':
                        wrapSelection(contentInput, '[', '](https://example.com)', 'link text');
                        break;
                    default:
                        break;
                }
            });
        });

        syncSlug();
        syncPreview();
    });
};

window.renderMarkdownPreview = renderMarkdown;
window.applyTheme = applyTheme;

applyTheme(getPreferredTheme());

document.addEventListener('DOMContentLoaded', () => {
    initThemeToggles();
    initMarkdownEditors();
});

document.addEventListener('livewire:navigated', () => {
    applyTheme(getPreferredTheme());
    initThemeToggles();
    initMarkdownEditors();
});
