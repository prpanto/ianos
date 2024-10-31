<script setup>
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'
import "leaflet.markercluster"
import "leaflet.markercluster/dist/MarkerCluster.css"

definePageMeta({
  middleware: ['sanctum:auth']
})

const map = ref(null)

const generateRandomCoordinates = (count) => {
  const latMin = 37.7046
  const latMax = 37.8333
  const lonMin = -122.8036
  const lonMax = -122.3543
  const coordinates = []

  for (let i = 0; i < count; i++) {
    const lat = Math.random() * (latMax - latMin) + latMin
    const lon = Math.random() * (lonMax - lonMin) + lonMin
    coordinates.push([lat, lon])
  }

  return coordinates
}

onMounted(() => {
  map.value = L.map("map").setView([37.7749, -122.4194], 12)

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
  }).addTo(map.value)

  const markers = L.markerClusterGroup()

  const randomCoordinates = generateRandomCoordinates(100)
  randomCoordinates.forEach(([lat, lon]) => {
    const marker = L.marker([lat, lon])
    markers.addLayer(marker)
  })

  map.value.addLayer(markers)
})
</script>

<template>
  <div id="map" style="height: 100%; width: 100%;"></div>
</template>
