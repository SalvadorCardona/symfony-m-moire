<template>
  <div>
    <visual-editor
        hidden
        name="content"
        preview="http://localhost:8080/front/visual-editor"
        iconsUrl="/assets/editor/[name].svg"
        value="[]"
    />
  </div>
</template>

<script setup lang="ts">
// import { VisualEditor } from '@boxraiser/visual-editor'
//
// const editor = new VisualEditor()
//
// editor.registerComponent('hero', {
//   title: 'Hero',
//   category: 'Banner',
//   fields: [
//     Text('title', {multiline: false}),
//     HTMLText('content'),
//     Repeater('buttons', {
//       title: 'Boutons',
//       addLabel: 'Add a new button',
//       fields: [
//         Row([
//           Text('label', { label: 'Label', default: 'Call to action' }),
//           Text('url', { label: 'Link' }),
//           Select('type', {
//             default: 'primary',
//             label: 'type',
//             options: [
//               { label: 'Primaire', value: 'primary' },
//               { label: 'Secondaire', value: 'secondary' }
//             ]
//           })
//         ])
//       ]
//     })
//   ]
// })

</script>