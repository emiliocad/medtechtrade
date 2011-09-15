REM @echo off
REM cs.bat usa PHP_CodeSniffer para detectar violaciones al estandar de codificación
REM para el proyecto Aptitus.
REM Se asume una variable de entorno llamada PHP_CS_BIN que debe devolver la ruta
REM hacia el CLI del PHP Code Sniffer
REM Se asume una variable de entorno llamada TEXT_EDITOR que debe devolver la ruta
REM hacia el editor de texto para ver el reporte
REM 
REM @author    Ernesto Anaya <eanaya@e-solutions.com.pe>

REM cls
REM %PHP_CS_BIN% -s --report-width=120 --extensions=php --standard=Zend --report-full=%TMP%\reporte-full.txt --report-summary=%TMP%\reporte-summary.txt ../src ^
REM  & type %TMP%\reporte-summary.txt > %TMP%\reporte.txt ^
REM  & type %TMP%\reporte-full.txt >> %TMP%\reporte.txt ^
REM  & %TEXT_EDITOR% %TMP%\reporte.txt & %PHP_CS_BIN%
 
cls
%PHP_CS_BIN% -s --report-width=120 --extensions=php --standard=Zend --report-full=%TMP%\reporte-full.txt --report-summary=%TMP%\reporte-summary.txt ../src ^
 & type %TMP%\reporte-summary.txt > %TMP%\reporte.txt ^
 & type %TMP%\reporte-full.txt >> %TMP%\reporte.txt ^
 & %TEXT_EDITOR% %TMP%\reporte.txt & %PHP_CS_BIN%