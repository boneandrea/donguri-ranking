'use strict'

/* eslint-disable */
const q = (s, root) => {
  if (root) {
    return root.querySelector(s)
  }
  return document.querySelector(s)
}
const qa = (s, root) => {
  if (root) {
    return root.querySelectorAll(s)
  }
  return document.querySelectorAll(s)
}

const qaa = (s, root) => {
  return [...qa(s, root)]
}

/* eslint-enable */

let currentButton = null
let live = false

const get_members = () =>
  qaa('form input')
    .filter((e) => e.checked)
    .map((e) => e.value)

q('form').addEventListener('change', (e) => {
  const _members = qaa('form input')
    .filter((e) => e.checked)
    .map((e) => e.value)
  if (_members.length > 4) {
    alert('Too many players')
    e.target.checked = false
  }
  console.log(get_members())
})

q('#submit').addEventListener('click', () => {
  if (!confirm('Start OK?')) return

  localStorage.setItem('live', false)
  localStorage.setItem('score', [])
  localStorage.setItem('golf_members', JSON.stringify(get_members()))
  window.location.href = './'
})
