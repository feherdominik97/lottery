// @ts-ignore
import { defineConfig } from 'vitest/config';
// @ts-ignore
import vue from '@vitejs/plugin-vue';
// @ts-ignore
import { fileURLToPath } from 'url';
// @ts-ignore
import { dirname, resolve } from 'path';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

export default defineConfig({
    plugins: [vue()],
    resolve: {
        alias: {
            '@': resolve(__dirname, './'),
        },
    },
    test: {
        environment: 'jsdom',
        globals: true,
        setupFiles: './tests/setup.ts',
    },
});