<?php

define('QUERY_REPORT_PRODUCTIVE_STAGE', "SELECT DISTINCT
        reg.RGN_ID CODIGO_REGIONAL, 
        REG.RGN_NOMBRE NOMBRE_REGIONAL, 
        s.SED_ID CODIGO_CENTRO, 
        S.SED_NOMBRE NOMBRE_CENTRO, 
        ASP.TIPO_DOCUMENTO TIPO_DOCUMENTO, 
        rga.num_doc_identidad NUM_DOCUMENTO,    
        asp.ASP_NOMBRE NOMBRE, 
        ASP.ASP_PRIMER_APELLIDO PRIMER_APELLIDO, 
        ASP.ASP_SEGUNDO_APELLIDO SEGUNDO_APELLIDO,      
        DECODE (usuario.dbu_genero, 'M','MASCULINO','F','FEMENINO','N','NO BINARIO')GENERO,      
        NVL(ASP.ASP_CORREO_E , ' ') CORREO,    
        NVL(ubicacion.ubu_tel_principal, ' ') TEL_1, 
        NVL(ubicacion.ubu_tel_alternativo, ' ') TEL_2,    
        NVL(ubicacion.ubu_tel_movil, ' ') TEL_3,  
        ubicacion.DPT_NOMBRE_RESIDENCIA DEPARTAMENTO_RESIDENCIA,   
        ubicacion.MPO_NOMBRE_RESIDENCIA MUNICIPIO_RESIDENCIA,  
        pf.prf_codigo ID_PROGRAMA,
        pf.prf_version VERSION_PROGRAMA,
        pf.prf_denominacion NOMBRE_PROGRAMA,
        nf.nfs_nombre NIVEL_FORMACION,
        CASE 
            WHEN PRF_DURACION_MAXIMA > 50 THEN ROUND(PRF_DURACION_MAXIMA/160)
            ELSE PRF_DURACION_MAXIMA
        END DURACION_PROGRAMA_MESES,
        fc.FIC_ID GRUPO_FICHA,    
        fc.fic_fch_inicializacion FECHA_INICIO_GRUPO_FICHA, 
        FIC_FCH_FINALIZACION FECHA_FIN_GRUPO_FICHA, 
        DECODE(fc.FIC_ESTADO,
        '1', 'Creada',
        '2', 'Personalizada',
        '3', 'Revisada',
        '4', 'Publicada',
        '5', 'En seleccion',
        '6', 'En matricula',
        '7', 'En ejecucion',
        '8', 'Terminada',
        '9', 'Cancelada',
        '10', 'Programada',
        '11', 'En Inscripcion',
        '12', 'Terminada por fecha',
        '13', 'Terminada por unificacion',
        '14', 'Inactivo Virtual') ESTADO_GRUPO_FICHA,     
        mpo.mpo_id ID_MUNICIPIO,
        mpo.mpo_nombre MUNICIPIO_RESIDENCIA,
        jor.jor_nombre JORNADA,        
        NVL(pe.PRE_NOMBRE, ' ') PROGRAMA_ESPECIAL,
        decode(fc.FIC_MOD_FORMACION, 'P', 'PRESENCIAL', 'V', 'VIRTUAL', 'C', 'COMBINADA', 'D', 'DESESCOLARIZADA', 'A', 'A DISTANCIA' ) MODALIDAD,
        decode(rga.rga_estado, 1, 'Aplazado',  2, 'Cancelado', 3, 'Certificado',   4, 'Condicionado',  5, 'Reprobado', 6, 'Retiro Voluntario', 7, 'Formacion', 8, 'Induccion', 9, 'No Apto',   10, 'Reingresado',  11, 'Traslado',     12, 'Por Certificar',   13, 'En Transito',  14, 'Cancelamiento Virtual Complementaria', 15, 'Desercion Virtual Complementaria') ESTADO_REGIS_ACADE_APREND,
        NVL(TO_CHAR(altper.AEP_FCH_REGISTRO, 'YYYY-MM-DD'), '0000-00-00') FECHA_REGISTRO_ALTERNATIVA_EP,
        NVL(alt.TAL_NOMBRE,' ') ALTERNATIVA_EP, 
        NVL(sta.STA_NOMBRE,' ') SUBTIPO_ALTERNATIVA_EP,
        NVL(decode(altper.AEP_ACCION, 1, 'Deshabilitar tipo alternativa',  2, 'Editar por error', 3, 'Editar por actualización',   4, 'Nueva alternativa'),' ') ACCION_REGISTRO_ALTERNATIVA_EP,
        NVL(TO_CHAR(altper.AEP_FCH_INICIAL, 'YYYY-MM-DD'), '0000-00-00') FECHA_INICIO_EP, 
        NVL(TO_CHAR(altper.AEP_FCH_FINAL, 'YYYY-MM-DD'), '0000-00-00') FECHA_FIN_EP,
        NVL(altper.AEP_ESTADO,' ') ESTADO_ALTERNATIVA,
        sum(decode(nvl(adr.adr_evaluacion_resultado,-1), 'A', 1, 0)) RAPS_APROBADOS,  
        sum(decode(nvl(adr.adr_evaluacion_resultado,-1), 'D', 1, 0)) RAPS_NO_APROBADOS,   
        sum(decode(nvl(adr.adr_evaluacion_resultado,-1), 'X', 1, 0)) RAPS_POR_EVALUAR,
        count(adr.adr_evaluacion_resultado) SUMATORIAS_RAPS,
        MAX(CASE WHEN cpr.cmp_ID = 2 THEN adr.ADR_FCH_EVALUO ELSE NULL END) AS FECHA_EMISION_RAP,
        MAX(CASE WHEN cpr.cmp_ID = 2 THEN decode(adr.adr_evaluacion_resultado, 'X', 'POR_EVALUAR', 'D', 'NO_APROBADO', 'A', 'APROBADO') ELSE NULL END) AS ESTADO_RAP_EP,
        MAX(CASE WHEN cpr.cmp_ID = 2 THEN decode(adr.ADR_EVALUACION_COMPETENCIA, 'X', 'POR_EVALUAR', 'D', 'NO_APROBADO', 'A', 'APROBADO') ELSE NULL END) AS ESTADO_CMP_EP    
        
    FROM 
        ejecformacion.alternativa_etapa_prod altper
        LEFT JOIN ejecformacion.tipo_alternativa alt ON altper.TAL_ID = alt.TAL_ID  
        LEFT JOIN ejecformacion.subtipo_alternativa sta ON altper.STA_ID = sta.STA_ID
        RIGHT JOIN matricula.registro_academico rga ON rga.RGA_ID = altper.RGA_ID      
        INNER JOIN INTEGRACION.ASPIRANTE_AV asp ON rga.nis = asp.nis    
        INNER JOIN ejecformacion.aprendizxdetalle_ruta adr ON adr.rga_id = rga.RGA_ID       
        INNER JOIN PLANFORMACION.FICHA_CARACTERIZACION fc ON fc.fic_id = rga.fic_id
        left outer join catalogo.municipio mpo on mpo.mpo_id = fc.mpo_id
        INNER JOIN catalogo.sede s ON s.sed_id =fc.SED_ID   
        INNER JOIN catalogo.regional reg ON reg.rgn_id = s.RGN_ID   
        INNER JOIN diseniocur.resultado_aprendizaje ra ON ra.rea_id = adr.rea_id    
        INNER JOIN diseniocur.competenciaxprograma cxp ON cxp.cpr_id = ra.cpr_id    
        INNER JOIN diseniocur.competencia cpr on cpr.CMP_ID = cxp.CMP_ID       
        INNER JOIN diseniocur.programa_formacion pf ON pf.prf_id = fc.prf_id    
        INNER JOIN catalogo.nivel_formacion nf ON nf.NFS_ID = pf.NFS_ID_OFRECIDO       
        INNER JOIN COMUN.ubicacion_usuario ubicacion ON ubicacion.NIS = rga.NIS 
        inner join COMUN.DATOS_BASICOS_USUARIO usuario on usuario.NIS = asp.NIS
        left outer join planformacion.PREXFIC pxf on pxf.fic_id = fc.fic_id  
        left outer join planformacion.programa_especial pe on pe.pre_id = pxf.pre_id  
        inner join catalogo.jornada jor on jor.jor_id = fc.jor_id    
            
    WHERE  
        pf.prf_tipo_programa = 'T'
        AND fc.fic_estado in ('7','8','12')
        AND (altper.AEP_ESTADO is null or altper.AEP_ESTADO = 1)
        and REA_ESTADO = 1
        AND fc.FIC_ID IN ( " . $tokenCodes . " )
        AND s.SED_ID IN ( " . $centerCode . " )    

    GROUP BY 
        reg.RGN_ID, REG.RGN_NOMBRE, s.SED_ID, S.SED_NOMBRE, ASP.TIPO_DOCUMENTO, rga.num_doc_identidad, asp.ASP_NOMBRE, ASP.ASP_PRIMER_APELLIDO, ASP.ASP_SEGUNDO_APELLIDO, usuario.dbu_genero, ASP.ASP_CORREO_E, ubicacion.ubu_tel_principal,
        ubicacion.ubu_tel_alternativo, ubicacion.ubu_tel_movil, ubicacion.DPT_NOMBRE_RESIDENCIA, ubicacion.MPO_NOMBRE_RESIDENCIA, pf.prf_codigo, pf.prf_version, pf.prf_denominacion, nf.nfs_nombre, pf.PRF_DURACION_MAXIMA, fc.FIC_ID,
        fc.fic_fch_inicializacion, FIC_FCH_FINALIZACION, altper.AEP_FCH_INICIAL, altper.AEP_FCH_FINAL, altper.AEP_FCH_REGISTRO, pe.PRE_NOMBRE, alt.TAL_NOMBRE, sta.STA_NOMBRE, 
        DECODE(fc.FIC_ESTADO, '1', 'Creada', '2', 'Personalizada', '3', 'Revisada', '4', 'Publicada', '5', 'En seleccion', '6', 'En matricula', '7', 'En ejecucion', '8', 'Terminada', '9', 'Cancelada', '10', 'Programada', '11', 'En Inscripcion', '12', 'Terminada por fecha', '13', 'Terminada por unificacion', '14', 'Inactivo Virtual'),  
        decode(fc.FIC_MOD_FORMACION, 'P', 'PRESENCIAL', 'V', 'VIRTUAL', 'C', 'COMBINADA', 'D', 'DESESCOLARIZADA', 'A', 'A DISTANCIA' ), jor.jor_nombre, fc.fic_tipo_respuesta, altper.AEP_ESTADO,
        decode(rga.rga_estado, 1, 'Aplazado', 2, 'Cancelado', 3, 'Certificado', 4, 'Condicionado', 5, 'Reprobado', 6, 'Retiro Voluntario', 7, 'Formacion', 8, 'Induccion', 9, 'No Apto', 10, 'Reingresado', 11, 'Traslado', 12, 'Por Certificar', 13, 'En Transito', 14, 'Cancelamiento Virtual Complementaria', 15, 'Desercion Virtual Complementaria'),  
        decode(altper.AEP_ACCION, 1, 'Deshabilitar tipo alternativa', 2, 'Editar por error', 3, 'Editar por actualización', 4, 'Nueva alternativa'),   mpo.mpo_id, mpo.mpo_nombre
");


define("QUERY_REPORT_ALTERNATIVE_PRODUCTIVE_STAGE_REGISTERED", "SELECT DISTINCT
        NVL(fc.FIC_ID, 0) ID_FICHA,
        NVL(TO_CHAR(fc.fic_fch_inicializacion, 'YYYY-MM-DD'), '0000-00-00') FECHA_INICIO_FICHA,
        NVL(TO_CHAR(FIC_FCH_FINALIZACION, 'YYYY-MM-DD'), '0000-00-00') FECHA_FIN_FICHA,
        NVL(reporte.desc_fic_estado(fc.fic_estado), ' ') ESTADO_GRUPO_FICHA,
        NVL(decode(pf.NFS_ID_OFRECIDO, 1 ,'AUXILIAR',  2 ,'TÉCNICO',  3 ,'INGENIERO TÉCNICO', 4 ,'TÉCNICO PROFESIONAL',   5 ,'ESPECIALIZACIÓN TÉCNICA',   6 ,'TECNÓLOGO', 7 ,'ESPECIALIZACIÓN TECNOLÓGICA',   8 ,'CURSO ESPECIAL',    9 ,'EVENTO DE DIVULGACIÓN TECNOLÓGICA', 10 ,'OPERARIO', 11 ,'COMPLEMENTARIA VIRTUAL',   12 ,'OCUPACION',    13 ,'TÉCNICO LABORAL',  100 ,'C.A.P. TRAB. CALIFICADO', 101 ,'DIPLOMA TECNICO', 102 ,'CERT.FORM.ESP.OFICIO',    103 ,'CERT.ESPECIALIZACION',    104 ,'DIPLOMA TECNICO PROFESIONAL', 105 ,'DIPLOMA TECNOLOGO',   107 ,'C.A.P. TECNICO',  108 ,'TRABAJADOR CALIFICADO',   109 ,'AYUDANTE',    200 ,'TECNÓLOGO INTERINSTITUCIONAL',    201 ,'TÉCNICO PROFESIONAL INTERINSTITUCIONAL',  202 ,'FORMACIÓN INTERINSTITUCIONAL',    223 ,'PROFUNDIZACIÓN TÉCNICA'), ' ') NIVEL_FORMACION,
        NVL(pf.prf_codigo, 0) CODIGO_PROGRAMA_FORMACION,
        NVL(pf.prf_version, 0) VERSION_PROGRAMA,  
        NVL(pf.prf_denominacion, ' ') NOMBRE_PROGRAMA,
        NVL(ASP.TIPO_DOCUMENTO, ' ') TIPO_DOCUMENTO, 
        NVL(rga.num_doc_identidad, 0) NUMERO_DOCUMENTO,    
        NVL(asp.ASP_NOMBRE, ' ') NOMBRE, 
        NVL(ASP.ASP_PRIMER_APELLIDO ||' '|| ASP.ASP_SEGUNDO_APELLIDO, ' ') APELLIDOS, 
        NVL(ubicacion.ubu_tel_principal, 0) CELULAR,
        NVL(ASP.ASP_CORREO_E, ' ') CORREO,
        NVL(alt.TAL_NOMBRE, ' ') ALTERNATIVA_EP,
        NVL(TO_CHAR(altper.AEP_FCH_INICIAL, 'YYYY-MM-DD'), '0000-00-00') FECHA_INICIO_EP_SOFIA, 
        NVL(TO_CHAR(altper.AEP_FCH_FINAL, 'YYYY-MM-DD'), '0000-00-00') FECHA_FIN_EP_SOFIA, 
        NVL(TO_CHAR(coa.coa_fch_inicio, 'YYYY-MM-DD'), '0000-00-00') FECHA_INICIO_EP_CAPRENDIZAJE,
        NVL(TO_CHAR(coa.coa_fch_fin, 'YYYY-MM-DD'), '0000-00-00') FECHA_FIN_EP_CAPRENDIZAJE,
        NVL(coa.COA_NIT_EMPRESA, 0) NIT_EMPRESA_CAPRENDIZAJE,
        NVL(coa.COA_RAZON_SOCIAL, ' ') NOMBRE_EMPRESA_CAPRENDIZAJE,
        NVL(coa.COA_NUM_CONTRATO, 0) N_CONTRATO_CAPRENDIZAJE,
        NVL(decode(coa.coa_estado, 1, 'Vigente',  2, 'Terminado', 3, 'Cadena de Formación',   4, 'Terminado por práctica o acuerdo' ), ' ') ESTADO_EP_CAPRENDIZAJE,    
        NVL(decode(rga.rga_estado, 1, 'Aplazado',  2, 'Cancelado', 3, 'Certificado',   4, 'Condicionado',  5, 'Reprobado', 6, 'Retiro Voluntario', 7, 'Formacion', 8, 'Induccion', 9, 'No Apto',   10, 'Reingresado',  11, 'Traslado',     12, 'Por Certificar',   13, 'En Transito',  14, 'Cancelamiento Virtual Complementaria', 15, 'Desercion Virtual Complementaria'), ' ') ESTADO_APRENDIZ
    FROM ejecformacion.alternativa_etapa_prod altper
        LEFT JOIN ejecformacion.tipo_alternativa alt ON altper.TAL_ID = alt.TAL_ID  
        RIGHT JOIN matricula.registro_academico rga ON rga.RGA_ID = altper.RGA_ID   
        INNER JOIN INTEGRACION.ASPIRANTE_AV asp ON rga.nis = asp.nis    
        INNER JOIN ejecformacion.aprendizxdetalle_ruta adr ON adr.rga_id = rga.RGA_ID   
        INNER JOIN INTEGRACION.ASPIRANTE_AV asp ON asp.nis = rga.NIS    
        INNER JOIN PLANFORMACION.FICHA_CARACTERIZACION fc ON fc.fic_id = rga.fic_id       
        INNER JOIN diseniocur.programa_formacion pf ON pf.prf_id = fc.prf_id       
        INNER JOIN comun.aspirante_vw pers ON pers.NIS = rga.NIS    
        INNER JOIN COMUN.ubicacion_usuario ubicacion ON ubicacion.NIS = pers.NIS 
        inner join COMUN.DATOS_BASICOS_USUARIO usuario on usuario.NIS = asp.NIS
        left JOIN EJECFORMACION.contrato_aprendizaje COA ON rga.nis = COA.nis        
    WHERE  
        pf.prf_tipo_programa = 'T'
        and fc.fic_mod_formacion in ('V','P','A')
        AND fc.fic_estado in ('7','8','12')
        and rga.rga_estado in (1,3,4,7,8,12) --1-Aplazado; 3-Certificado; 4-Condicionado; 7-Formacion; 8-Induccion; 12-Por Certificar;
        AND (altper.AEP_ESTADO is null or altper.AEP_ESTADO = 1)
        AND fc.FIC_ID IN ( " . $tokenCodes . " )
");
