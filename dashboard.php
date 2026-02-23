<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location:https://lightskyblue-dunlin-466295.hostingersite.com/adiumplataform/index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard - Hybrid Layout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .custom-scroll::-webkit-scrollbar {
            height: 8px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }

        .main-wrapper {
            max-width: 100vw;
            overflow: hidden;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">

    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5">
            <div class="flex items-center justify-between">
                <div id="logoytexto" class="flex items-center gap-2">
                    <img src="assets/img/logo_faro_avif.avif" alt="" class="w-16 h-16">
                    <span class="text-xl font-bold text-blue-700 uppercase">Adium-faro-stats</span>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" id="logout"
                        class="w-12 h-8 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-bold"
                        >
                        Salir
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-24 px-6 main-wrapper">
        <div class="flex gap-6 items-start">

            <!-- PANEL IZQUIERDO: Formulario de entrada -->
            <section id="fixed-form-container">
                <div
                    class="min-w-[400px] bg-white rounded-[2.5rem] shadow-sm p-8 border border-gray-100 flex flex-col justify-between">
                    <form id="metrics-input-form" class="p-4">
                        <div class="flex flex-col mb-8">
                            <h2 class="text-2xl font-black text-slate-800 uppercase leading-tight">ADIUM PERÚ</h2>
                            <div class="mt-4">
                                <select name="id_mes"
                                    class="bg-white border border-gray-300 text-sm rounded-lg p-1.5 focus:ring-blue-500 outline-none">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-row space-x-4 mb-6">
                            <input type="text"
                                class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 focus:ring-blue-500 outline-none text-center"
                                name="link_reporte_social" placeholder="REPORTE SOCIAL">
                            <input type="text"
                                class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 focus:ring-blue-500 outline-none text-center"
                                name="link_reporte_plataforma" placeholder="REPORTE PLATAFORMA">
                        </div>

                        <div class="flex flex-col gap-4">
                            <span class="text-[13px] font-bold text-slate-800 uppercase">Adium Pro</span>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Inversión</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Meta Ads</label><input
                                        type="number" name="adium_metaads"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Google Ads</label><input
                                        type="number" name="adium_googleads"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Linkedin Ads</label><input
                                        type="number" name="adium_lkads"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Posts social</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Facebook</label><input
                                        type="number" name="adium_social_facebook"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Instagram</label><input
                                        type="number" name="adium_social_instagram"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Posts web</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Publicaciones</label><input
                                        type="number" name="adium_web_publicaciones"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Cursos</label><input
                                        type="number" name="adium_web_cursos"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Visitas</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Nuevo</label><input
                                        type="number" name="adium_visitas_nuevo"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Recurrente</label><input
                                        type="number" name="adium_visitas_recurente"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Tráfico</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Pagado</label><input
                                        type="number" name="adium_trafico_pagado"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Orgánico</label><input
                                        type="number" name="adium_trafico_organico"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-0 mt-2">
                                <div class="flex items-center gap-4"><label
                                        class="text-[13px] font-bold text-slate-700 w-40 text-left">Tiempo</label><input
                                        type="number" name="adium_tiempo"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4"><label
                                        class="text-[13px] font-bold text-slate-700 w-40 text-left">Rebote</label><input
                                        type="number" name="adium_rebote"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4"><label
                                        class="text-[13px] font-bold text-slate-700 w-40 text-left">Conversiones</label><input
                                        type="number" name="adium_conversiones"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="flex flex-col gap-4">
                            <span class="text-[13px] font-bold text-slate-800 uppercase">Mi Salud es Hoy</span>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Inversión</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Meta Ads</label><input
                                        type="number" name="mseh_inversion_metaads"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Google Ads</label><input
                                        type="number" name="mseh_googleads"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Linkedin Ads</label><input
                                        type="number" name="mesh_lkads"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Posts social</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Facebook</label><input
                                        type="number" name="mseh_social_facebook"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Instagram</label><input
                                        type="number" name="mseh_social_instagram"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Posts web</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Entiende tu
                                        enfermedad</label><input type="number" name="mseh_web_ete"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Viviendo tu
                                        enfermedad</label><input type="number" name="mseh_web_vtv"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Visitas</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Nuevo</label><input
                                        type="number" name="mseh_visitas_nuevo"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Recurrente</label><input
                                        type="number" name="mseh_visitas_recurrente"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Tráfico</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Pagado</label><input
                                        type="number" name="mesh_trafico_pagado"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Orgánico</label><input
                                        type="number" name="mseh_trafico_organico"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-0 mt-2">
                                <div class="flex items-center gap-4"><label
                                        class="text-[13px] font-bold text-slate-700 w-40 text-left">Tiempo</label><input
                                        type="number" name="mseh_tiempo"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4"><label
                                        class="text-[13px] font-bold text-slate-700 w-40 text-left">Rebote</label><input
                                        type="number" name="mseh_rebote"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="flex flex-col gap-4">
                            <span class="text-[13px] font-bold text-slate-800 uppercase">Institucional</span>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Inversión</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Meta Ads</label><input
                                        type="number" name="insti_metaads"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Google Ads</label><input
                                        type="number" name="insti_googleads"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Linkedin Ads</label><input
                                        type="number" name="insti_lkads"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Posts social</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Facebook</label><input
                                        type="number" name="insti_social_facebook"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Instagram</label><input
                                        type="number" name="insti_social_instagram"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Visitas</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Nuevo</label><input
                                        type="number" name="insti_visitas_nuevo"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Recurrente</label><input
                                        type="number" name="insti_visitas_recurrente"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-4">
                                <span class="text-[13px] font-bold text-slate-700">Tráfico</span>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Pagado</label><input
                                        type="number" name="insti_trafico_pagado"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4 ml-4"><label
                                        class="text-[13px] text-slate-600 w-32 text-right">Orgánico</label><input
                                        type="number" name="insti_trafico_organico"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 ml-0 mt-2">
                                <div class="flex items-center gap-4"><label
                                        class="text-[13px] font-bold text-slate-700 w-40 text-left">Tiempo</label><input
                                        type="number" name="insti_tiempo"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                                <div class="flex items-center gap-4"><label
                                        class="text-[13px] font-bold text-slate-700 w-40 text-left">Rebote</label><input
                                        type="number" name="insti_rebote"
                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded-xl transition-colors">
                                + Agregar registro
                            </button>
                        </div>

                    </form>
                </div>
            </section>

            <!-- PANEL DERECHO: Cards de registros (scroll horizontal) -->
            <div id="scroll-container" class="custom-scroll flex gap-6 overflow-x-auto pb-6 snap-x w-full">
                <!-- Los cards se renderizan aquí desde JS -->
            </div>

        </div>
    </main>
    <script src="assets/js/dashboard.js"></script>


</body>

</html>