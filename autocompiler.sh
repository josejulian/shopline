#!bin/bash

#Este script permanece observando los archivos de un directorio y si alguno cambia recompila los archivos .less

if [ $# -lt 3 ]; then
    echo "Debe ingresar 3 paramentro en el siguiente orden: [directorio a observar] [directorio que guardara el fichero css compilado] [nombre del fichero a compilar] )";
else
    if [ $# -eq 3 ]; then
        if [ -d $1 ]; then
            if [ -d $2 ]; then
                if [ -e $1$3 ]; then
            filename=$( echo ${3%.*});
            #echo "El nombre del archivo es: $filename";
                    #echo "el direcotrio a observar existe";
                    #echo "el direcotrio que guardara el .css compilado existe";
                    #echo "El archivo .less acompilar existe";
                    projectPath=$(pwd);     
                    echo $projectPath;
                    if [ -d /tmp/$1 ]; then
                        #echo "El directorio ya se encuentra en /tmp";              
                        for i in $(ls -l $1 | grep -v "^d" | awk '{print $9 }')
                        do
                            #echo "Creando archivo temporal $i...";
                            cp $1$i /tmp/$1$i;
                        done
                    else
                        cd /tmp;
                        #echo "Creando directorio $1 dentro de /tmp";  
                        for i in $(echo $1 | awk -F "/" '{while(i++<NF) print $i}')
                        do
                            mkdir $i; cd $i
                        done
                        cd $projectPath;
                        for i in $(ls -l $1 | grep -v "^d" | awk '{print $9 }')
                        do
                            #echo "Creando archivo temporal $i...";
                            cp $1$i /tmp/$1$i;
                        done
                    fi
                    while : ; do 
                        for i in $(ls -l $1 | grep -v "^d" | awk '{print $9 }')
                        do
                            var=$(find $1$i -newer /tmp/$1$i);  
                            if ( test "$var" != "" ); then
                                echo "$i ha sido modificado";
                    cp $1$i /tmp/$1$i;
                                
                lessc $1$3 > $2$filename".css";
                            # else
                                # echo "$i no ha cambiado";
                            fi      
                        done
                        sleep 1; 
                    done        
                else
                    echo "el archivo $3 no existe";
                fi
            else
                echo "el directorio $2 no existe";
            fi
        else
            echo "el directorio $1 no existe";
        fi
    fi
fi