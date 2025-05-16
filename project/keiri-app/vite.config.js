import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {globSync} from 'glob';

import fs from 'fs-extra';
import path from 'path';

const folder = {
    src_assets: 'resources', // source assets files
    dist_assets: 'public/build',  // build assets files
};

export default defineConfig({
    server: {
        hmr: false
    },
    build: {
        minify: true, // esbuild (default)
        outDir: folder.dist_assets, // src location build
        emptyOutDir: true,
        cssCodeSplit: true, // spit file css
        rollupOptions: {
            output: {
                assetFileNames: (asset) => {
                    const originalName = asset.names?.[0] || '';
                    const ext = originalName.split('.').pop();

                    const imageExtensions = ['png', 'jpg', 'jpeg', 'gif', 'svg'];
                    const fontExtensions = ['woff', 'woff2', 'ttf', 'otf', 'eot'];

                    if (ext === 'css') {
                        return 'css/[name].min.css';
                    } else if (fontExtensions.includes(ext)) {
                        return `fonts/[name].[ext]`;
                    } else if (imageExtensions.includes(ext)) {
                        return `images/[name].[ext]`;
                    } else {
                        return `css/assets/${originalName}`;
                    }
                },
                entryFileNames: (chunkInfo) => {
                    const filePath = chunkInfo.facadeModuleId;
                    if (filePath && filePath.includes('resources\\js')) {
                        if (filePath.includes('pages')) {
                            return 'js/pages/[name].min.js';
                        }
                    }
                    return 'js/[name].min.js';
                },
                chunkFileNames: () => {
                    return 'js/vendor/[name].js';
                },
                manualChunks: (id) => {
                    if (id.includes('node_modules')) {
                        if (id.includes('bootstrap')) return 'bootstrap';
                        if (id.includes('flatpickr')) return 'flatpickr';
                        if (id.includes('choices')) return 'choices';
                        if (id.includes('fullcalendar')) return 'fullcalendar';
                        if (id.includes('feather-icons')) return 'feather-icons';
                        return 'vendor';
                    }
                    return undefined;
                }
            },
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/scss/bootstrap.scss',
                'resources/scss/app.scss',
                'resources/scss/icons.scss',
                ...globSync('resources/js/*.js'),
                ...globSync('resources/js/pages/*.js'),
            ],
            refresh: false,
        }),
        {
            name: 'copy-assets-and-packages',
            async writeBundle() {
                // Copy images, fonts
                try {
                    await Promise.all([
                        fs.copy(`${folder.src_assets}/fonts`, `${folder.dist_assets}/fonts`),
                        fs.copy(`${folder.src_assets}/images`, `${folder.dist_assets}/images`),
                    ])
                } catch (error) {
                    console.error('Error copying assets:', error);
                }
            }
        }
    ],
    resolve:
        {
            alias: {
                '_': path.resolve(__dirname, 'node_modules'),
                '@': path.resolve(__dirname, 'resources/js'),
                '@css': '/resources/css',
            }
        }
    ,
    css: {
        preprocessorOptions: {
            scss: {
                silenceDeprecations: [
                    'import',
                    'mixed-decls',
                    'color-functions',
                    'global-builtin',
                    'legacy-js-api',
                ],
            }
        }
    }
});
