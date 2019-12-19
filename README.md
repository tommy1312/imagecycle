# TYPO3 Extension Imagecycle

This repository is replacing the TYPO3 Extension
[Imagecycle](https://typo3.org/extensions/repository/view/imagecycle) and it has been built starting from the former fork at [a7digital Imagecycle](https://github.com/a7digital/imagecycle).

## Remarks

The scope is to bring back functionality and compatibility for newer versions of TYPO3 CMS. There are future plans to continue maintaining this extension on a voluntary basis. You are invited to make contributions as issues and pull requests or pay my further work.

## Side notes

Various parts have been adjusted to be compatible with TYPO3 CMS 7 LTS and 8 LTS again. Besides that, the previous custom TCA user functions that have been used in the FlexForm structures have been replaced as much as possible by a cleaner way following the new FormEngine paradigms, that have been introduced during the development phase of TYPO3 CMS 7. Custom ExtJS components have been replaced by accordant TYPO3 Core functions, based on jQuery and Bootstrap.

However, a jQuery/TWBS color-picker is not yet implemented - neither in this extension nor in the TYPO3 Core. That is why the "old" color picker of the TYPO3 Core is being used again (find further details in issue [#73728](https://forge.typo3.org/issues/73728)).

## Inspiring People to Share

An extension upgrade for the TYPO3 CMS 9 and 10 should come one day.

