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
                        return `css/assets/images/[name].[ext]`;
                    } else {
                        return `css/assets/${originalName}`;
                    }
                },
                entryFileNames: (chunkInfo) => {
                    const filePath = chunkInfo.facadeModuleId;
                    if (filePath && filePath.includes('resources\\js')) {
                        if (filePath.includes('pages')) {
                            if (filePath.includes('base_ui')) {
                                return 'js/pages/base_ui/[name].min.js';
                            }
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
                        if (id.includes('bootstrap')) return 'libs/bootstrap';
                        if (id.includes('flatpickr')) return 'libs/flatpickr';
                        if (id.includes('choices')) return 'libs/choices';
                        if (id.includes('fullcalendar')) return 'libs/fullcalendar';
                        if (id.includes('feather-icons')) return 'libs/feather-icons';
                        if (id.includes('prismjs')) return 'libs/prismjs';
                        if (id.includes('toastify')) return 'libs/toastify-js';
                        if (id.includes('imagesloaded')) return 'libs/imagesloaded';
                        if (id.includes('masonry-layout')) return 'libs/masonry-layout';
                        if (id.includes('node-waves')) return 'libs/node-waves';
                        return 'libs/vendor';
                    }
                    if (id.includes('resources/js/features')) {
                        if (id.includes('calendar')) return 'features/calendar';
                    }
                    if (id.includes('resources/js/common')) {
                        return 'common';
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
                ...globSync('resources/js/pages/base_ui/*.js'),
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
                        fs.copy(`${folder.src_assets}/lang`, `${folder.dist_assets}/lang`),
                        fs.copy(`${folder.src_assets}/json`, `${folder.dist_assets}/json`),
                    ])
                } catch (error) {
                    console.error('Error copying assets:', error);
                }

                const configPath = path.resolve(__dirname, `${folder.src_assets}/vite.config.json`);
                const inputPath = path.resolve(__dirname, 'node_modules');
                const outputPath = path.resolve(__dirname, `${folder.dist_assets}/libs`);

                try {
                    const configContent = await fs.readFile(configPath, 'utf-8');
                    const {packagesToCopy} = JSON.parse(configContent);

                    for (const item of packagesToCopy) {
                        const sourcePath = path.join(inputPath, item.folderNameNodeModule);

                        if (item.copyAll) {
                            try {
                                await fs.access(sourcePath, fs.constants.F_OK);
                                const destPackagePath = path.join(outputPath, item.folderNameNodeModule);
                                await fs.copy(sourcePath, destPackagePath);
                                console.log(`✅ Copied entire folder: ${sourcePath} to ${destPackagePath}`);
                            } catch (error) {
                                console.error(`❌ Failed to copy entire folder: ${sourcePath}`);
                            }
                        } else {
                            for (const fileOrFolder of item.files) {
                                const sourceFileOrFolderPath = path.join(sourcePath, fileOrFolder);
                                const destFileOrFolderPath = path.join(outputPath, item.folderNameNodeModule, fileOrFolder);

                                try {
                                    const stats = await fs.stat(sourceFileOrFolderPath);

                                    if (stats.isDirectory()) {
                                        await fs.copy(sourceFileOrFolderPath, destFileOrFolderPath);
                                        console.log(`✅ Copied directory ${sourceFileOrFolderPath} to ${destFileOrFolderPath}`);
                                    } else {
                                        await fs.copy(sourceFileOrFolderPath, destFileOrFolderPath);
                                        console.log(`✅ Copied file ${sourceFileOrFolderPath} to ${destFileOrFolderPath}`);
                                    }
                                } catch (error) {
                                    console.error(`❌ Failed to copy ${sourceFileOrFolderPath}`);
                                }
                            }
                        }
                    }

                } catch (error) {
                    console.error('Error reading package copy config or copying files:', error);
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
