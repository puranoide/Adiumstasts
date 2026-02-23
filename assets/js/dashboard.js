const urlbackend = "controllers/";
const websiteroot = "https://lightskyblue-dunlin-466295.hostingersite.com/adiumstatsfaro";
const buttonsalir = document.getElementById("logout");
buttonsalir.addEventListener("click", () => {
  event.preventDefault(); // Evita que el formulario se envíe
  fetch(urlbackend + "auth.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      action: 'logout'
    })
  })
    .then(response => response.json())
    .then(data => {
      console.log(data);
      window.location.href = websiteroot + "index.html";
    })
    .catch(error => {
      console.error('Error:', error);
    });
  return false; // Evita que el formulario se envíe
});


const formulario = document.getElementById("metrics-input-form");
formulario.addEventListener("submit", function (event) {
  event.preventDefault();
  const formData = new FormData(this);
  const data = Object.fromEntries(formData);
  console.log(data);
  insertarDatos(data);
});

function insertarDatos(data) {
  fetch(urlbackend + "registros.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      action: "insert",
      data: data
    }),
  })
    .then((response) => response.json())
    .then((result) => {
      console.log(result);
      location.reload();
    })
    .catch((error) => {
      console.error("Error al insertar datos:", error);
    });
}


function getAllRegistros() {
    fetch(urlbackend + "registros.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ action: "list" }),
    })
    .then((response) => response.json())
    .then((result) => {
        if (result.error) { console.error(result.error); return; }
        renderAllCards(result.data);
    })
    .catch((error) => console.error("Error al listar registros:", error));
}

// ─────────────────────────────────────────────
// MAPEAR objeto plano del backend → estructura de card
// ─────────────────────────────────────────────
function mapBackendToCard(d) {
    const meses = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

    return {
        mes: meses[Number(d.id_mes) - 1] ?? `Mes ${d.id_mes}`,
        links: [
            { label: "REPORTE SOCIAL",     url: d.link_reporte_social,     title: "Reporte social" },
            { label: "REPORTE PLATAFORMA", url: d.link_reporte_plataforma, title: "Reporte plataforma" },
        ],
        marcas: [
            {
                nombre: "Adium Pro",
                secciones: [
                    {
                        titulo: "Inversión",
                        valorPrincipal: `S/.${+d.adium_metaads + +d.adium_googleads + +d.adium_lkads}`,
                        detalles: [
                            { label: "Meta Ads",     valor: `S/.${d.adium_metaads}` },
                            { label: "Google Ads",   valor: `S/.${d.adium_googleads}` },
                            { label: "LinkedIn Ads", valor: `S/.${d.adium_lkads}` },
                        ]
                    },
                    {
                        titulo: "Post social",
                        valorPrincipal: +d.adium_social_facebook + +d.adium_social_instagram,
                        detalles: [
                            { label: "Facebook",  valor: d.adium_social_facebook },
                            { label: "Instagram", valor: d.adium_social_instagram },
                        ]
                    },
                    {
                        titulo: "Posts web",
                        valorPrincipal: +d.adium_web_publicaciones + +d.adium_web_cursos,
                        detalles: [
                            { label: "Publicaciones", valor: d.adium_web_publicaciones },
                            { label: "Cursos",        valor: d.adium_web_cursos },
                        ]
                    },
                    {
                        titulo: "Visitas",
                        valorPrincipal: +d.adium_visitas_nuevo + +d.adium_visitas_recurente,
                        detalles: [
                            { label: "Nuevo",      valor: d.adium_visitas_nuevo },
                            { label: "Recurrente", valor: d.adium_visitas_recurente },
                        ]
                    },
                    {
                        titulo: "Tráfico",
                        valorPrincipal: +d.adium_trafico_pagado + +d.adium_trafico_organico,
                        detalles: [
                            { label: "Pagado",   valor: d.adium_trafico_pagado },
                            { label: "Orgánico", valor: d.adium_trafico_organico },
                        ]
                    },
                ],
                metricasSimples: [
                    { label: "Tiempo",       valor: `${d.adium_tiempo} min` },
                    { label: "Rebote",       valor: `${d.adium_rebote}%` },
                    { label: "Conversiones", valor: `${d.adium_conversiones}%` },
                ]
            },
            {
                nombre: "Mi Salud es Hoy",
                secciones: [
                    {
                        titulo: "Inversión",
                        valorPrincipal: `S/.${+d.mseh_inversion_metaads + +d.mseh_googleads + +d.mseh_lkads}`,
                        detalles: [
                            { label: "Meta Ads",     valor: `S/.${d.mseh_inversion_metaads}` },
                            { label: "Google Ads",   valor: `S/.${d.mseh_googleads}` },
                            { label: "LinkedIn Ads", valor: `S/.${d.mseh_lkads}` },
                        ]
                    },
                    {
                        titulo: "Post social",
                        valorPrincipal: +d.mseh_social_facebook + +d.mseh_social_instagram,
                        detalles: [
                            { label: "Facebook",  valor: d.mseh_social_facebook },
                            { label: "Instagram", valor: d.mseh_social_instagram },
                        ]
                    },
                    {
                        titulo: "Posts web",
                        valorPrincipal: +d.mseh_web_ete + +d.mseh_web_vte,
                        detalles: [
                            { label: "ETE", valor: d.mseh_web_ete },
                            { label: "VTE", valor: d.mseh_web_vte },
                        ]
                    },
                    {
                        titulo: "Visitas",
                        valorPrincipal: +d.mseh_visitas_nuevo + +d.mseh_visitas_recurrente,
                        detalles: [
                            { label: "Nuevo",      valor: d.mseh_visitas_nuevo },
                            { label: "Recurrente", valor: d.mseh_visitas_recurrente },
                        ]
                    },
                    {
                        titulo: "Tráfico",
                        valorPrincipal: +d.mesh_trafico_pagado + +d.mseh_trafico_organico,
                        detalles: [
                            { label: "Pagado",   valor: d.mesh_trafico_pagado },
                            { label: "Orgánico", valor: d.mseh_trafico_organico },
                        ]
                    },
                ],
                metricasSimples: [
                    { label: "Tiempo",  valor: `${d.mseh_tiempo} min` },
                    { label: "Rebote",  valor: `${d.mseh_rebote}%` },
                ]
            },
            {
                nombre: "Institucional",
                secciones: [
                    {
                        titulo: "Inversión",
                        valorPrincipal: `S/.${+d.insti_metaads + +d.insti_googleads + +d.insti_lkads}`,
                        detalles: [
                            { label: "Meta Ads",     valor: `S/.${d.insti_metaads}` },
                            { label: "Google Ads",   valor: `S/.${d.insti_googleads}` },
                            { label: "LinkedIn Ads", valor: `S/.${d.insti_lkads}` },
                        ]
                    },
                    {
                        titulo: "Post social",
                        valorPrincipal: +d.insti_social_facebook + +d.insti_social_instagram,
                        detalles: [
                            { label: "Facebook",  valor: d.insti_social_facebook },
                            { label: "Instagram", valor: d.insti_social_instagram },
                        ]
                    },
                    {
                        titulo: "Visitas",
                        valorPrincipal: +d.insti_visitas_nuevo + +d.insti_visitas_recurrente,
                        detalles: [
                            { label: "Nuevo",      valor: d.insti_visitas_nuevo },
                            { label: "Recurrente", valor: d.insti_visitas_recurrente },
                        ]
                    },
                    {
                        titulo: "Tráfico",
                        valorPrincipal: +d.insti_trafico_pagado + +d.insti_trafico_organico,
                        detalles: [
                            { label: "Pagado",   valor: d.insti_trafico_pagado },
                            { label: "Orgánico", valor: d.insti_trafico_organico },
                        ]
                    },
                ],
                metricasSimples: [
                    { label: "Tiempo", valor: `${d.insti_tiempo} min` },
                    { label: "Rebote", valor: `${d.insti_rebote}%` },
                ]
            },
        ]
    };
}

// ─────────────────────────────────────────────
// RENDERIZADO DE UN CARD (sin cambios)
// ─────────────────────────────────────────────
function renderCard(data) {
    return `
        <section class="snap-start">
            <div class="min-w-[400px] bg-white rounded-[2.5rem] shadow-sm p-8 border border-gray-100 flex flex-col justify-between">
                <form class="p-4">

                    <div class="flex flex-col mb-8">
                        <h2 class="text-2xl font-black text-slate-800 uppercase leading-tight">Adium Perú</h2>
                        <div class="mt-4">
                            <input name="month" value="${data.mes}" readonly
                                class="bg-white border border-gray-300 text-sm rounded-lg p-1.5 outline-none text-gray-400">
                        </div>
                    </div>

                    <div class="flex flex-row space-x-4 mb-6">
                        ${data.links.map(link => `
                            <a href="${link.url}" target="_blank"
                                class="w-40 text-gray-400 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none text-center hover:bg-gray-50 transition-colors"
                                title="${link.title}">${link.label}</a>
                        `).join('')}
                    </div>

                    <hr class="mb-6 border-gray-100">

                    ${data.marcas.map((marca, index) => `
                        <div class="flex flex-col gap-4 ${index !== data.marcas.length - 1 ? 'mb-8' : ''}">
                            <span class="text-[13px] font-bold text-slate-800 uppercase">${marca.nombre}</span>

                            ${marca.secciones.map(seccion => `
                                <div class="flex flex-col gap-2 ml-4">
                                    <details class="bg-white rounded-lg">
                                        <summary style="cursor:pointer;" class="text-[13px] font-bold text-slate-700">
                                            ${seccion.titulo}: ${seccion.valorPrincipal}
                                        </summary>
                                        <div class="flex flex-col gap-3 ml-4 mt-3">
                                            ${seccion.detalles.map(det => `
                                                <div class="flex items-center gap-4">
                                                    <label class="text-[13px] text-slate-600 w-32 text-right">${det.label}</label>
                                                    <input type="text" value="${det.valor}" readonly
                                                        class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none text-slate-600 text-center"/>
                                                </div>
                                            `).join('')}
                                        </div>
                                    </details>
                                </div>
                            `).join('')}

                            <div class="flex flex-col gap-2 ml-0 mt-1">
                                ${marca.metricasSimples.map(ms => `
                                    <div class="flex items-center gap-4">
                                        <label class="text-[13px] font-bold text-slate-700 w-40 text-left">${ms.label}</label>
                                        <input type="text" value="${ms.valor}" readonly
                                            class="w-40 bg-white border border-gray-400 text-xs rounded-lg p-1 outline-none text-slate-600 text-center"/>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                        ${index !== data.marcas.length - 1 ? '<hr class="my-4 border-gray-100">' : ''}
                    `).join('')}

                </form>
            </div>
        </section>
    `;
}

// ─────────────────────────────────────────────
// RENDERIZAR TODOS LOS CARDS
// ─────────────────────────────────────────────
function renderAllCards(registrosBackend) {
    const container = document.getElementById('scroll-container');
    // Mapear cada objeto plano → estructura de card → HTML
    const cardsHtml = registrosBackend
        .map(d => renderCard(mapBackendToCard(d)))
        .join('');

    if (!cardsHtml) {
        container.innerHTML = '<p class="text-center text-[13px] font-bold text-slate-600">Aún no hay registros para mostrar.</p>';
    } else {
        container.innerHTML = cardsHtml;
    }

    const lastCard = container.lastElementChild;
    if (lastCard) lastCard.scrollIntoView({ behavior: 'instant' });
}


document.addEventListener('DOMContentLoaded', () => {
    getAllRegistros();
});