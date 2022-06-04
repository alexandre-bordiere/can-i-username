export function useStringHelpers() {
  return { capitalize }
}

function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1)
}
