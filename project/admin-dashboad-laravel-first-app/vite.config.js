import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {globSync} from 'glob';

import fs from 'fs-extra';
import path from 'path';

const folder = {
    src_assets: 'resources', // source assets files
    dist_assets: 'public/build'  //build assets files
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

                    if (ext === 'css') {
                        return 'css/[name].min.css';
                    } else {
                        return `icons/${originalName}`;
                    }
                },
                entryFileNames: (chunkInfo) => {
                    const filePath = chunkInfo.facadeModuleId || '';

                    if (!filePath.includes('resources/js/')) {
                        const relativePath = path.relative(path.resolve('resources/js'), filePath);

                        if (relativePath.includes('pages')) {
                            return `js/pages/[name].min.js`;
                        }
                        return `js/[name].min.js`;
                    }
                },
            },
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/scss/bootstrap.scss',
                'resources/scss/app.scss',
                'resources/scss/icons.scss',
                ...globSync('resources/js/pages/*.js'),
                ...globSync('resources/js/*.js'),
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

                const configPath = path.resolve(__dirname, `${folder.src_assets}/packages.config.json`);
                const inputPath = path.resolve(__dirname, 'node_modules');
                const outputPath = path.resolve(__dirname, `${folder.dist_assets}/libs`);

                try {
                    const configContent = await fs.readFile(configPath, 'utf-8');
                    const {packagesToCopy} = JSON.parse(configContent);

                    for (const item of packagesToCopy) {
                        const sourcePath = path.join(inputPath, item.name);

                        if (item.copyAll) {
                            try {
                                await fs.access(sourcePath, fs.constants.F_OK);
                                const destPackagePath = path.join(outputPath, item.name);
                                await fs.copy(sourcePath, destPackagePath);
                                console.log(`✅ Copied entire folder: ${sourcePath} to ${destPackagePath}`);
                            } catch (error) {
                                console.error(`❌ Failed to copy entire folder: ${sourcePath}`);
                            }
                        } else {
                            for (const fileOrFolder of item.files) {
                                const sourceFileOrFolderPath = path.join(sourcePath, fileOrFolder);
                                const destFileOrFolderPath = path.join(outputPath, item.name, fileOrFolder);

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
    resolve: {
        alias: {
            '@': 'resources/js/',
            '@css': '/resources/css',
        }
    },
    css: {
        preprocessorOptions: {
            scss: {
                silenceDeprecations: [
                    'import',
                    'global-builtin',
                    'color-functions',
                    'mixed-decls'
                ]
            }
        }
    }
});
